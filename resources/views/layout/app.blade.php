<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TasksApp</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/tasksSort.js') }}"></script>

</head>
<body>
    <div class="container-main">
    <header style="margin-bottom:20px">
        <a href="{{ route('projects.index') }}" class="btn btn-primary">Projects</a>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">New Project</a>
        <a href="{{ route('tasks.index') }}" class="btn btn-primary" style="margin-left: 20px">Tasks</a>         
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">New Task</a>
   
    </header>

    <main>
        <center>
        
            @if ($errors->any())
                <div class="alert alert-warning">
                    
                        @foreach ($errors->all() as $error)
                            {{ $error }} <br/>
                        @endforeach
                
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-warning">
                    {{ session('error') }}
                </div>
            @endif
            

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
        
    </main>
</center>
</body>
</html>
