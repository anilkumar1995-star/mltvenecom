@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/ecommerce') }}">Ecommerce</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </nav>

        <div class="toolbar d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex gap-2 align-items-center">
                <div class="dropdown" id="bulkDropdown">
                    <button id="bulkToggle" class="btn btn-outline-secondary btn-sm">Bulk Actions <i class="fas fa-chevron-down ms-2"></i></button>
                    <div id="bulkMenu" class="dropdown-menu-custom d-none">
                        <button type="button" id="bulkDeleteAction" class="dropdown-item btn btn-blank">Delete</button>
                    </div>
                </div>
                <form id="searchForm" method="GET" action="{{ route('admin.products.index') }}">
                    <div class="search-input input-group input-group-sm">
                        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search...">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus me-1"></i> Create</a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">Reload</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form id="bulkForm" action="{{ route('admin.products.bulk_delete') }}" method="POST">
            @csrf
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light small text-muted">
                            <tr>
                                <th style="width:40px"><input id="selectAll" type="checkbox" /></th>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Stock Status</th>
                                <th>Quantity</th>
                                <th>SKU</th>
                                <th>Sort Order</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th class="text-end">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td><input class="row-check" type="checkbox" name="ids[]" value="{{ $product->id }}" /></td>
                                    <td>{{ $product->id }}</td>
                                    <td style="width:80px"><img src="{{ optional($product->images->first())->url ?? 'https://via.placeholder.com/60' }}" alt="" style="width:60px;height:60px;object-fit:cover;border-radius:4px"></td>
                                    <td>
                                        <a href="{{ route('admin.products.edit', $product) }}">{{ $product->name }}</a>
                                        <div class="small text-muted">{{ $product->type ?? 'Physical' }}</div>
                                    </td>
                                    <td>{{ $product->price ? '$'.number_format($product->price,2) : '—' }}</td>
                                    <td><span class="text-{{ $product->stock_status == 'In stock' ? 'success' : 'muted' }}">{{ $product->stock_status ?? '—' }}</span></td>
                                    <td>{{ $product->quantity ?? '—' }}</td>
                                    <td>{{ $product->sku ?? '—' }}</td>
                                    <td>{{ $product->sort_order ?? 0 }}</td>
                                    <td>{{ optional($product->created_at)->format('Y-m-d') }}</td>
                                    <td>{!! $product->status == 'published' ? '<span class="badge bg-success">Published</span>' : '<span class="badge bg-secondary">Draft</span>' !!}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-primary btn-icon-square"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline-block" class="confirm-delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger btn-icon-square btn-delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="small text-muted d-flex align-items-center">
                            <i class="fas fa-globe me-2"></i>
                            <span>Show from 1 to {{ $products->count() }} in</span>
                            <span class="record-pill ms-2">{{ $products->total() }}</span>
                            <span class="ms-2">records</span>
                        </div>
                        <div>{{ $products->links() }}</div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Confirmation modal markup -->
        <div id="confirmModal" class="confirm-modal d-none" role="dialog" aria-modal="true" aria-hidden="true">
            <div class="confirm-modal-backdrop"></div>
            <div class="confirm-modal-dialog">
                <button class="confirm-close" aria-label="Close">×</button>
                <div class="d-flex align-items-start">
                    <div class="confirm-icon-left me-3">
                        <i class="fas fa-exclamation"></i>
                    </div>
                    <div class="flex-grow-1 text-center">
                        <h4 class="confirm-title">Confirm to perform this action</h4>
                        <p class="confirm-body small text-muted">Are you sure you want to do this action? This cannot be undone.</p>
                    </div>
                </div>
                <div class="d-flex gap-2 mt-3 justify-content-end">
                    <button id="confirmCancel" class="btn btn-outline-secondary">Cancel</button>
                    <button id="confirmOk" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>

        <script>
            (function(){
                const selectAll = document.getElementById('selectAll');
                const rowChecks = document.querySelectorAll('.row-check');
                const bulkForm = document.getElementById('bulkForm');

                if(selectAll){
                    selectAll.addEventListener('change', function(){
                        rowChecks.forEach(ch => ch.checked = selectAll.checked);
                    });
                }

                const bulkToggle = document.getElementById('bulkToggle');
                const bulkMenu = document.getElementById('bulkMenu');
                const bulkDeleteAction = document.getElementById('bulkDeleteAction');
                const bulkDropdown = document.getElementById('bulkDropdown');

                function anySelected(){
                    return Array.from(rowChecks).some(ch => ch.checked);
                }

                if(bulkToggle){
                    bulkToggle.addEventListener('click', function(e){
                        e.preventDefault();
                        bulkMenu.classList.toggle('d-none');
                    });
                }

                // confirmation modal handlers
                const modalEl = document.getElementById('confirmModal');
                const modalOk = document.getElementById('confirmOk');
                const modalCancel = document.getElementById('confirmCancel');
                const modalCloseBtn = modalEl ? modalEl.querySelector('.confirm-close') : null;
                let pendingConfirmAction = null;

                function showConfirm(callback){
                    pendingConfirmAction = callback;
                    if(modalEl) {
                        modalEl.classList.remove('d-none');
                        modalEl.setAttribute('aria-hidden', 'false');
                    }
                }
                function hideConfirm(){
                    if(modalEl){
                        modalEl.classList.add('d-none');
                        modalEl.setAttribute('aria-hidden', 'true');
                    }
                    pendingConfirmAction = null;
                }

                if(bulkDeleteAction){
                    bulkDeleteAction.addEventListener('click', function(e){
                        e.preventDefault();
                        if(!anySelected()){
                            alert('Please select at least one item.');
                            return;
                        }
                        showConfirm(function(){ bulkForm.submit(); });
                    });
                }

                document.querySelectorAll('.btn-delete').forEach(function(btn){
                    btn.addEventListener('click', function(e){
                        e.preventDefault();
                        const form = btn.closest('form');
                        if(!form) return;
                        showConfirm(function(){ form.submit(); });
                    });
                });

                if(modalOk){
                    modalOk.addEventListener('click', function(){
                        if(pendingConfirmAction) pendingConfirmAction();
                        hideConfirm();
                    });
                }
                if(modalCancel) modalCancel.addEventListener('click', hideConfirm);
                if(modalCloseBtn) modalCloseBtn.addEventListener('click', hideConfirm);

                document.addEventListener('click', function(e){
                    if(!bulkDropdown.contains(e.target)){
                        if(bulkMenu && !bulkMenu.classList.contains('d-none')) bulkMenu.classList.add('d-none');
                    }
                });
            })();
        </script>
    </div>
@endsection
