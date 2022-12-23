<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
  public function index()
  {
    $images = Storage::disk('public')->files('images');
    return view('file_upload', ['images' => $images]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'image' => ['required', 'image', 'file'],
    ]);

    $request->file('image')->store('images', 'public');

    return redirect()->route('index');
  }

  public function destroy(Request $request)
  {
    $validated = $request->validate([
      'path' => ['required'],
    ]);

    Storage::disk('public')->delete($validated['path']);

    return redirect()->route('index');
  }
}
