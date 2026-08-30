<div class="container mt-3">
    <div class="d-flex justify-content-end">
        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="btn btn-danger">
                Sair
            </button>
        </form>
    </div>
</div>