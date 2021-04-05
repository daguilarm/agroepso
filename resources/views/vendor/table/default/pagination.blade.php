<div class="text-center">
    {{ trans('table::pagination.showing') }} {{($paginator->currentPage() - 1) * $paginator->perPage()}} - {{$paginator->currentPage() * $paginator->perPage()}} {{ trans('table::pagination.from') }} {{$paginator->total()}} {{ trans('table::pagination.records') }}
</div>
<nav>
    {{ $paginator->links() }}
</nav>