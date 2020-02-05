


    <div class="field">
        <label for="title" class="label">Title</label>

        <div class="control">
                <input type="text" name="title" id="" class="input" 
                placeholder="Title"
                value="{{ $project->title }}" required>
        </div>
    </div>
    <div class="field">
        <label for="description" class="label">Description</label>

        <div class="control">
                <textarea name="description" id="" cols="30" rows="10" class="textarea" required>{{ $project->description }}</textarea>
        </div>
    </div>

    <div class="field">


        <div class="control">
                <button type="submit" class="button is-link">{{ $buttonText }}</button>
        </div>


        <a href="{{ $project->path() }}" >Cancel</a>


    </div>


@if ($errors->any())        
    <div class="field mt-6">
            @foreach ($errors->all() as $error)
                <li class="text-small text-red-600">{{ $error }}</li>
            @endforeach
    </div>
@endif

