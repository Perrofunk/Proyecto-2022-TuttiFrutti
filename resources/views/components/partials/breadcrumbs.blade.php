 {{-- resources/views/partials/breadcrumbs.blade.php --}}
<style>
    .breadcrumbs {
  border: 1px solid #cbd2d9;
  border-radius: 0.3rem;
  display: inline-flex;
  overflow: hidden;
}

.breadcrumbs_item {
  background: #fff;
  color: #333;
  outline: none;
  padding: 0.75em 0.75em 0.75em 1.25em;
  position: relative;
  text-decoration: none;
  transition: background 0.2s linear;
}

.breadcrumbs_item:hover:after,
.breadcrumbs_item:hover {
  background: #edf1f5;
}

.breadcrumbs_item:focus:after,
.breadcrumbs_item:focus,
.breadcrumbs_item.is-active:focus {
  background: #323f4a;
  color: #fff;
}

.breadcrumbs_item:after,
.breadcrumbs_item:before {
  background: white;
  bottom: 0;
  clip-path: polygon(50% 50%, -50% -50%, 0 100%);
  content: "";
  left: 100%;
  position: absolute;
  top: 0;
  transition: background 0.2s linear;
  width: 1em;
  z-index: 1;
}

.breadcrumbs_item:before {
  background: #cbd2d9;
  margin-left: 1px;
}

.breadcrumbs_item:last-child {
  border-right: none;
}

.breadcrumbs_item.is-active {
  background: #edf1f5;
}
</style>
 @unless ($breadcrumbs->isEmpty())
 <nav class="breadcrumbs">
     @foreach ($breadcrumbs as $breadcrumb)

         @if (!is_null($breadcrumb->url) && !$loop->last)
            <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
         @else
             <li class="breadcrumbs-item active">{{ $breadcrumb->title }}</li>
         @endif

     @endforeach
 </nav>
@endunless