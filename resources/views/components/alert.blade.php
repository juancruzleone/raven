<?php
/** @var string $message */
/** @var string $type */

switch ($type) {
    case 'success':
        $classes = "alert-success";
        // $classes = "bg-green-100 text-green-800"; // Ej: Tailwind
        break;

    case 'danger':
    case 'error':
        $classes = "alert-danger";
        // $classes = "bg-red-100 text-red-800"; // Ej: Tailwind
        break;

    default:
        $classes = "alert-success";
        // $classes = "bg-green-100 text-green-800"; // Ej: Tailwind
        break;
}
?>
<div class="alert {{ $classes }}">{!! $message !!}</div>
