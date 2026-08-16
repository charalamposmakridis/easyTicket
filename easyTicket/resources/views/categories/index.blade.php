@extends('layouts.app')

@section('content')
    <h1>Categories</h1>

    <p>
        <a href="{{ route('categories.create') }}">+ Create New Category</a>
    </p>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category) }}">Edit</a> |

                    <form method="POST" action="{{ route('categories.destroy', $category) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No categories found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <br>
    <div>
        {{ $categories->links() }}
    </div>
@endsection
