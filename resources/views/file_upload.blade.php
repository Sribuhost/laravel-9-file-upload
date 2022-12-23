<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Laravel 9 File Upload - Sribuhost</title>

  <link rel="stylesheet" href="{{ asset('style.css') }}" />
</head>

<body>
  <div class="container">
    <h1 class="title">Laravel 9 File Upload - <a href="https://sribuhost.com" target="_blank">Sribuhost</a></h1>
    <p class="subtitle">
      Upload and delete file using Laravel 9 framework.
    </p>
    <hr />
    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data" class="form">
      @csrf
      <div class="form__group">
        <label for="image" class="form__label">Select an image</label>
        <input type="file" name="image" id="image" class="form__file" accept="image/*" required />
      </div>
      <button type="submit" class="button button_primary">Upload</button>
    </form>
    <table class="table">
      <tr>
        <th>Preview</th>
        <th>Size</th>
        <th>Last Modified</th>
        <th>Action</th>
      </tr>
      @foreach ($images as $image)
        <tr>
          <td><img src="{{ asset('storage/' . $image) }}" alt="" class="img-thumbnail" /></td>
          <td>{{ Storage::disk('public')->size($image) / 1000 }} KB</td>
          <td>{{ date('d M Y', Storage::disk('public')->lastModified($image)) }}</td>
          <td>
            <form action="{{ route('destroy') }}" method="POST">
              @method('DELETE')
              @csrf
              <input type="hidden" name="path" value="{{ $image }}">
              <button type="submit" class="button button_danger button_sm">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table>
  </div>
</body>

</html>
