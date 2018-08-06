<form method="POST" action="{{ url('/monsters/' . $monster->id ) }}">
    {{ csrf_field() }}
    <div class="form-group">
        <textarea class="form-control" name="article" rows="7" required>
        </textarea>
        <button type="submit" class="btn btn-success">
            Save Article
        </button>
    </div>
</form>