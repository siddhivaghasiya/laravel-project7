@extends('admin::admin.layout')


@section('body')

      <div class="card">
        <div class="card-body">
            <div>
                <h3 class="ab"> &nbsp; Blog {{trans('lang_data.listing_lable')}}
                </h3>
            </div>



            <h4><a href="{{ route('blog.create') }}" class="btn btn-info btn-sm">{{trans('lang_data.addnew_lable')}}
            </a></h4>

            <div class="table-responsive">
            <table class="table table-bordered"  id="users-table">
              <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Categories</th>
                    <th>Tags</th>
                    <th>Image</th>
                    <th>{{trans('lang_data.status_lable')}}</th>
                    <th>{{trans('lang_data.action_lable')}}</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>


  <script>
      var oTable = $('#users-table').DataTable({
          processing: true,
          serverSide: true,
          searching:false,
          responsive: true,
          ajax: {
                url:'{!! route('blog.listing') !!}',
                data: function (d) {

                }
              },
          columns: [
            { data: 'id'},
            { data: 'title'},
            { data: 'categories'},
            { data: 'tags'},
            { data: 'image'},
            { data: 'status'},
            { data: 'action'},
          ]
      });
      </script>
@endsection

