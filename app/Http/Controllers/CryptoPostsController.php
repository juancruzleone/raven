<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;

class CryptoPostsController extends Controller
{
    protected array $createRules = [
        'title' => 'required|string|min:8',
        'content' => 'required|string|min:8',
        'category_id' => 'required',
        'cover' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:2048', // Modificado para hacer la portada obligatoria
        'cover_description' => 'required|string|min:8|max:255',
    ];

    public function index(Request $request)
    {
        $searchTitle = $request->input('s-title', '');
        $categoryId = $request->input('category_id', '');

        $query = Post::with('category'); // Eager loading de category
        if (!empty($searchTitle)) {
            $query->where('title', 'LIKE', '%' . $searchTitle . '%');
        }
        if (!empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        $cryptoPosts = $query->paginate(3);

        $categories = Category::all();

        return view('blog', [
            'cryptoPosts' => $cryptoPosts,
            'searchTitle' => $searchTitle,
            'categories' => $categories,
            'selectedCategoryId' => $categoryId,
        ]);
    }

    public function view(int $id)
    {
        $post = Post::with('category')->findOrFail($id); // Eager loading de category

        return view('posts.view', [
            'post' => $post,
        ]);
    }

    public function createForm()
    {
        $categories = Category::all();
        return view('posts.create', ['categories' => $categories]);
    }

    public function createProcess(Request $request)
    {
        $request->validate($this->createRules, [
            'title.required' => 'El título es obligatorio.',
            'title.min' => 'El título debe tener al menos 2 caracteres.',
            'content.required' => 'El contenido es obligatorio.',
            'content.min' => 'El contenido debe tener al menos 8 caracteres.', // Mensaje para el campo 'content'
            'category_id.required' => 'La categoría es obligatoria.',
            'cover.required' => 'La portada es obligatoria.',
            'cover.image' => 'El campo de portada debe ser una imagen.',
            'cover.mimes' => 'El campo de portada debe ser un archivo de tipo: jpeg, png, jpg, webp, gif.',
            'cover.max' => 'El campo de portada no debe ser mayor a 2048 kilobytes.',
            'cover_description.required' => 'La descripción de la portada es obligatoria.',
            'cover_description.min' => 'La descripción de la portada debe tener al menos 8 caracteres.', // Mensaje para el campo 'cover_description'
            'cover_description.max' => 'La descripción de la portada no debe ser mayor a 255 caracteres.',
        ]);
    
        $data = $request->except('_token');
    
        $post = new Post();
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->category_id = $data['category_id'];
    
        if ($request->hasFile('cover')) {
            $imagePath = $request->file('cover')->store('', 'covers');
            $post->cover = basename($imagePath);
        }
    
        $post->cover_description = $data['cover_description'];
        $post->save();
    
        return redirect()
            ->route('blog')
            ->with('status', 'El post "' . $post->title . '" se publicó con éxito.');
    }
    

    public function editForm(int $id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('posts.edit', ['post' => $post, 'categories' => $categories]);
    }

    public function editProcess(int $id, Request $request)
{
    $post = Post::findOrFail($id);

    $request->validate([
        'title' => 'required|string|min:8',
        'content' => 'required|string|min:8',
        'category_id' => 'required',
        'cover' => [
            'nullable', // Cambiado a nullable
            'image',
            'mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/webp',
            'max:2048',
            function ($attribute, $value, $fail) {
                if ($value) {
                    $allowedExtensions = ['jpeg', 'png', 'jpg', 'gif', 'webp'];
                    $extension = $value->getClientOriginalExtension();
                    if (!in_array($extension, $allowedExtensions)) {
                        $fail("El campo de portada debe ser un archivo de tipo: " . implode(', ', $allowedExtensions) . ".");
                    }
                }
            },
        ],
       'cover_description' => 'required|string|min:8|max:255',
    ], [
        'title.required' => 'El título es obligatorio.',
        'title.min' => 'El título debe tener al menos 2 caracteres.',
        'content.required' => 'El contenido es obligatorio.',
        'category_id.required' => 'La categoría es obligatoria.',
        'cover.image' => 'El campo de portada debe ser una imagen.',
        'cover.mimetypes' => 'El campo de portada debe ser un archivo de tipo: jpeg, png, jpg, webp, gif.',
        'cover.max' => 'El campo de portada no debe ser mayor a 2048 kilobytes.',
        'cover_description.required' => 'La descripción de la portada es obligatoria.', // Nuevo mensaje de error para la descripción obligatoria
    ]);

    $data = $request->except('_token');

    $post->title = $data['title'];
    $post->content = $data['content'];
    $post->category_id = $data['category_id'];

    if ($request->hasFile('cover')) {
        if ($post->cover) {
            Storage::disk('covers')->delete($post->cover);
        }

        $imagePath = $request->file('cover')->store('', 'covers');
        $post->cover = basename($imagePath);
    }

    $post->cover_description = $data['cover_description'];
    $post->save();

    return redirect()
        ->route('blog')
        ->with('status', 'El post "' . $post->title . '" se editó con éxito.');
}



    public function deleteForm(int $id)
    {
        $post = Post::findOrFail($id);

        return view('posts.delete', [
            'post' => $post,
        ]);
    }

    public function deleteProcess(int $id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect()
            ->route('blog')
            ->with('status', 'El post se eliminó con éxito.');
    }

    public function blog()
    {
        $searchTitle = FacadesRequest::input('s-title', '');
        $categoryId = FacadesRequest::input('category_id', '');

        $query = Post::with('category'); // Eager loading de category
        if (!empty($searchTitle)) {
            $query->where('title', 'LIKE', '%' . $searchTitle . '%');
        }
        if (!empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        $perPage = 3; // Número de elementos por página
        $cryptoPosts = $query->paginate($perPage);

        // Personalizar el texto de paginación
        $paginationText = "Mostrando " . $cryptoPosts->firstItem() . " a " .
            $cryptoPosts->lastItem() . " de " . $cryptoPosts->total() . " resultados";

        $categories = Category::all();

        return view('blog', [
            'cryptoPosts' => $cryptoPosts,
            'searchTitle' => $searchTitle,
            'paginationText' => $paginationText,
            'categories' => $categories,
            'selectedCategoryId' => $categoryId,
        ]);
    }
}
