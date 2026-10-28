<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --cream: #fbf5e1;
            --sky: #cdeef2;
            --leaf: #6cc070;
            --leaf-dark: #3f8f4f;
            --wood: #b4835a;
            --bark: #5b4636;
            --sun: #ffd86b;
            --blush: #f7a8a0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Nunito', system-ui, sans-serif;
            color: var(--bark);
            background-color: var(--sky);
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.55) 2px, transparent 2px);
            background-size: 28px 28px;
        }

        main {
            max-width: 680px;
            margin: 0 auto;
            padding: 40px 16px;
        }

        h1,
        h2,
        h3,
        button {
            font-family: 'Fredoka', 'Nunito', sans-serif;
        }

        header {
            text-align: center;
            margin-bottom: 32px;
        }

        h1 {
            margin: 0;
            font-size: 2.8rem;
            font-weight: 600;
            color: var(--leaf-dark);
            text-shadow: 0 2px 0 rgba(255, 255, 255, 0.7);
        }

        .subtitle {
            margin: 8px 0 0;
            opacity: 0.7;
        }

        .success {
            margin-bottom: 24px;
            padding: 12px 20px;
            border: 2px solid var(--sun);
            border-radius: 16px;
            background: rgba(255, 216, 107, 0.45);
            font-weight: 700;
        }

        .card {
            background: var(--cream);
            border: 4px solid #fff;
            border-radius: 32px;
            padding: 24px;
            box-shadow: 0 8px 20px rgba(180, 131, 90, 0.25);
        }

        .card h2 {
            margin: 0 0 16px;
            font-size: 1.5rem;
            font-weight: 500;
            color: var(--wood);
        }

        .field {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 4px;
            font-size: 0.9rem;
            font-weight: 700;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px 16px;
            font: inherit;
            color: var(--bark);
            background: #fff;
            border: 2px solid rgba(180, 131, 90, 0.35);
            border-radius: 16px;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        input[type="text"]::placeholder,
        textarea::placeholder {
            color: rgba(91, 70, 54, 0.4);
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: var(--leaf);
            box-shadow: 0 0 0 4px rgba(108, 192, 112, 0.3);
        }

        textarea {
            resize: vertical;
        }

        .error {
            margin: 8px 0 0;
            padding: 6px 12px;
            font-size: 0.9rem;
            font-weight: 700;
            color: #8a1c1c;
            background: rgba(247, 168, 160, 0.5);
            border-radius: 12px;
        }

        button[type="submit"] {
            padding: 10px 28px;
            font-size: 1.1rem;
            font-weight: 500;
            color: #fff;
            background: var(--leaf);
            border: none;
            border-radius: 999px;
            cursor: pointer;
            box-shadow: 0 4px 0 var(--leaf-dark);
            transition: filter 0.15s, transform 0.1s, box-shadow 0.1s;
        }

        button[type="submit"]:hover {
            filter: brightness(1.06);
        }

        button[type="submit"]:active {
            transform: translateY(4px);
            box-shadow: none;
        }

        .section-title {
            margin: 40px 0 16px;
            font-size: 1.5rem;
            font-weight: 500;
            color: var(--leaf-dark);
        }

        .task {
            margin-bottom: 16px;
            padding: 20px;
            background: var(--cream);
            border: 4px solid #fff;
            border-radius: 24px;
            box-shadow: 0 5px 12px rgba(180, 131, 90, 0.25);
            transition: transform 0.15s;
        }

        .task:hover {
            transform: translateY(-2px);
        }

        .task-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .task h3 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 500;
        }

        .task p {
            margin: 8px 0 0;
            opacity: 0.85;
        }

        .badge {
            flex-shrink: 0;
            padding: 4px 12px;
            font-size: 0.75rem;
            font-weight: 700;
            border-radius: 999px;
        }

        .badge-done {
            color: #fff;
            background: var(--leaf);
        }

        .badge-pending {
            color: var(--bark);
            background: var(--sun);
        }

        .empty {
            padding: 32px;
            text-align: center;
            opacity: 0.8;
            background: rgba(251, 245, 225, 0.7);
            border: 4px dashed rgba(180, 131, 90, 0.45);
            border-radius: 24px;
        }
    </style>
</head>

<body>
    <main>

        <header>
            <h1> My Tasks</h1>
            <p class="subtitle">What's on the island agenda today?</p>
        </header>

        @if (session('success'))
            <div class="success"> {{ session('success') }}</div>
        @endif

        <form class="card" action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <h2>New Task</h2>

            <div class="field">
                <label for="task_title">Task title</label>
                <input type="text" id="task_title" name="task_title" value="{{ old('task_title') }}"
                    placeholder="e.g. Water the flowers">
                @error('task_title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3"
                    placeholder="Any extra details? (optional)">{{ old('description') }}</textarea>
                @error('description')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">Add Task</button>
        </form>

        <h2 class="section-title">Saved Tasks</h2>

        @forelse ($tasks as $task)
            <article class="task">
                <div class="task-top">
                    <h3>{{ $task->task_title }}</h3>

                    @if ($task->completed)
                        <span class="badge badge-done">✓ Completed</span>
                    @else
                        <span class="badge badge-pending">⏳ Not completed</span>
                    @endif
                </div>

                <p>{{ $task->description ?: 'No description provided.' }}</p>
            </article>
        @empty
            <div class="empty"> No tasks have been added yet. Plant your first one above!</div>
        @endforelse

    </main>
</body>

</html>
