<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts CRUD</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f9f9f9; }
        .container { max-width: 700px; margin: auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px #ddd; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f0f0f0; }
        a, button { color: #007bff; text-decoration: none; border: none; background: none; cursor: pointer; }
        form { display: inline; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        .actions { display: flex; gap: 10px; }
        .btn { padding: 6px 12px; border-radius: 4px; background: #007bff; color: #fff; border: none; cursor: pointer; }
        .btn-danger { background: #dc3545; }
        .btn-secondary { background: #6c757d; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Posts</h1>
        <a href="{{ url('posts/create') }}" class="btn">Create New Post</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td><a href="{{ url('posts/'.$post->id) }}">{{ $post->title }}</a></td>
                    <td class="actions">
                        <a href="{{ url('posts/'.$post->id.'/edit') }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ url('posts/'.$post->id) }}" method="POST" onsubmit="return confirm('Delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if (isset($showForm) && $showForm)
            <h2>{{ isset($edit) ? 'Edit' : 'Create' }} Post</h2>
            <form action="{{ isset($edit) ? url('posts/'.$post->id) : url('posts') }}" method="POST">
                @csrf
                @if(isset($edit))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $post->title ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" rows="5" required>{{ old('content', $post->content ?? '') }}</textarea>
                </div>
                <button type="submit" class="btn">{{ isset($edit) ? 'Update' : 'Create' }}</button>
                <a href="{{ url('posts') }}" class="btn btn-secondary">Cancel</a>
            </form>
        @elseif (isset($showPost) && $showPost)
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
            <a href="{{ url('posts') }}" class="btn btn-secondary">Back to List</a>
        @endif
    </div>
</body>
</html> 