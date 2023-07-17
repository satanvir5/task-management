@extends('layouts.app')

@section('content')



<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif


    <div class="d-flex justify-content-end mb-4">
        <a class="btn btn-primary" href="{{ route('tasks.create') }}">Create</a>
      </div>

    <table class="table table-striped table-bordered datatable">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Deadline</th>
            <th>Assigned User</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($tasks  as $task )
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->deadline }}</td>
                    <td>{{ isset($task->assignUser)? $task->assignUser->name: '' }}</td>
                    <td>
                        @if ( $task->assigned_user)
                        <button type="button" class="btn btn-info" >
                            Already Assigned
                        </button>
                        @else
                        <button type="button" class="btn btn-primary" onclick="assignMember({{ $task->id}})">
                            Assign Member
                        </button>
                        @endif


                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
</div>

<div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="assignModalLabel">Assign Members</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">


            <div id="loader" class="d-none">
                <div class="spinner-border text-primary position-fixed top-50 start-50 translate-middle" role="status">
                <span class="visually-hidden">Loading...</span>
                </div>
            </div>
          <form id="assignForm" action="{{ route('taskAssign') }}" method="POST">
            @csrf
            <input type="text" class="form-control" id="searchInput" placeholder="Search users...">
            <input type="hidden" class="form-control" id="task_id" name="task_id">
            <select multiple class="form-select mt-2" id="userList" name="selected_user" >

            </select>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="submitAssignForm()">Assign</button>
        </div>
      </div>
    </div>
  </div>


@endsection


@push('scripts')
    <script>

        function submitAssignForm() {
            // Get the form element
            const form = document.getElementById('assignForm');

            // Create a new FormData object and append the form data
            const formData = new FormData(form);
            const loader = document.getElementById('loader');

              // Show the loader
            loader.classList.remove('d-none');

            // Send the form data using AJAX
            fetch(form.action, {
            method: 'POST',
            body: formData
            })
            .then(response => {
                $('#assignModal').modal('hide');
                // Handle the response here
                alert('Task assined successfully!');
                loader.classList.add('d-none');
                location.reload();
                // You can show a success message or perform any other action upon successful form submission
            })
            .catch(error => {
                // Handle any errors that occurred during form submission
                loader.classList.add('d-none');
                console.error('Form submission error:', error);
            });
        }

        // Populate the user list with searchable options
        function populateUserList() {
            const users = {!! json_encode($users) !!};

            const searchInput = document.getElementById("searchInput");
            const userList = document.getElementById("userList");

            userList.innerHTML = "";
            const searchText = searchInput.value.toLowerCase();

            users.forEach(user => {
            if (user.name.toLowerCase().includes(searchText)) {
                const option = document.createElement("option");
                option.value = user.id;
                option.text = user.name;
                userList.appendChild(option);
            }
            });
        }

        // Assign selected members
        function assignMembers() {
            const selectedUserIds = Array.from(document.getElementById("userList").selectedOptions)
            .map(option => option.value);
            // Close the modal
            submitAssignForm();


        }

        // Event listener for search input
        $(document).keyup('#searchInput',function(){
            searchInput.focus();
            populateUserList();
        })

        // Event listener when the modal is shown
        const assignModal = document.getElementById("assignModal");
        assignModal.addEventListener("shown.bs.modal", () => {
            searchInput.focus();
            populateUserList();
        });

        function assignMember(taskId){
            $('#task_id').val(taskId);
            populateUserList();
            $('#assignModal').modal('show');
        }

    </script>
@endpush

