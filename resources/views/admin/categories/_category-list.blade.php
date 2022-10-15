@foreach ( $categories as $categori )
  <!-- category list -->
  <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
    <label class="mt-auto mb-auto">
      <!-- todo: show category title -->
      {{ str_repeat('-', $count).' '.$categori->title }}
    </label>
    <div>
      <!-- detail -->
      <a href="#" class="btn btn-sm btn-primary" role="button">
        <i class="fas fa-eye"></i>
      </a>
      <!-- edit -->
      <a href="{{ route('categories.edit',['category'=>$categori]) }}" class="btn btn-sm btn-info" role="button">
        <i class="fas fa-edit"></i>
      </a>
      <!-- delete -->
      <form class="d-inline" action="{{ route('categories.destroy', ['category'=>$categori]) }}" role="alert" method="POST" alert-text="{{ $categori->title }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
          <i class="fas fa-trash"></i>
        </button>
      </form>
    </div>
    <!-- todo:show subcategory -->
    @if ($categori->descendants)
      @include('admin.categories._category-list',[
        'categories' => $categori->descendants,
        'count' => $count + 2
      ])
      @endif
  </li>
  <!-- end  category list -->
@endforeach
