<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">

    <title>BirdBoard</title>
</head>
<body>


    <form  class="container" method="POST" action="/projects">
        @csrf

        <h1 class="heading is-1">
            Create a project
        </h1>

        <div class="field">
            <label for="title" class="label">Title</label>

            <div class="control">
                    <input type="text" name="title" id="" class="input" placeholder="Title">
            </div>
        </div>
        <div class="field">
            <label for="description" class="label">Description</label>

            <div class="control">
                    <textarea name="description" id="" cols="30" rows="10" class="textarea"></textarea>
            </div>
        </div>

        <div class="field">


            <div class="control">
                    <button type="submit" class="button is-link">Create Project</button>
            </div>
        </div>



    </form>

</body>
</html>
