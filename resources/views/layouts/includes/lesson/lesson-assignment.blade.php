@if ($rank->hasRank('instructor')) 
  <a href="{{route('class.single', ['id'=> $row->id, 'tab' => 'single-lesson', 'tab1' => 'add-lesson-assignment','single_lesson_id' => $single_lesson_row->id])}}">
      <button class="btn btn-primary float-end btn-sm">
        <i class="bi bi-plus"></i>
          Add New
      </button>
  </a>
@endif