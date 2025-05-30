@if (isset($data['groups_list']) && $data['groups_list']->count() > 0)
<div class="table-responsive1">
    <table id="example-1" class="table align-middle mb-0 table-hover table-centered">
        <thead class="bg-light-subtle">
            <tr>
                <th>Sr. No.</th>
                <th>Name</th>
                <!-- <th>Percentage (%)</th> -->
                <th>Group Category Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            $sr_no = 1;
            @endphp
            @foreach($data['groups_list'] as $groups_list_row)
            <tr>
                <td>{{ $sr_no }}</td>
                <td>
                    {{ $groups_list_row->name }}

                </td>
                <!-- <td>
                    {{ $groups_list_row->group_percentage }}
                </td> -->
                
                <td>
                {{ $groups_list_row->groupCategory->name }}
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="javascript:void(0);"
                        data-editgroup-popup="true" data-groupid="{{$groups_list_row->id}}" data-size="lg" data-title="Edit {{ $groups_list_row->name }}"
                        data-url="{{ route('edit-group', $groups_list_row->id) }}"
                        data-bs-toggle="tooltip" data-bs-original-title="Edit {{ $groups_list_row->name }}"
                        class="btn btn-soft-success btn-sm">
                            <i class="ti ti-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('group.delete', $groups_list_row->id) }}" style="margin-left: 10px;">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                                <a href="javascript:void(0);" title="Delete {{ $groups_list_row->name }}" data-name="{{ $groups_list_row->name }}" class="show_confirm btn btn-soft-danger btn-sm" data-title="Delete {{ $groups_list_row->name }}" data-bs-toggle="tooltip" >
                                <i class="ti ti-trash"></i>
                            </a>
                        </form>
                        <!-- <a href="javascript:void(0);" data-title="Delete {{ $groups_list_row->name }}"
                        data-url="{{ route('group.delete', $groups_list_row->id) }}"
                        data-bs-toggle="tooltip" data-bs-original-title="Delete {{ $groups_list_row->name }}"
                        class="btn btn-soft-danger btn-sm delete-confirm">
                            <i class="ti ti-trash"></i>
                        </a> -->
                    </div>
                </td>
            </tr>
            @php
            $sr_no++;
            @endphp
            @endforeach
        </tbody>
    </table>
</div>
@endif