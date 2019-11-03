@extends('layouts.app')
@section('content')
	<div class="content">
		<div class="container">
				<table id="example" class="display" style="width:100%">
					<thead>
						<tr>
							<th>First name</th>
							<th>Last name</th>
							<th>Email</th>
							<th>Address</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>First name</th>
							<th>Last name</th>
							<th>Email</th>
							<th>Address</th>
						</tr>
					</tfoot>
				</table>
		</div>
	</div>
	<script type="text/javascript">
		$(function () {
			$('#example tfoot th').each( function () {
				var title = $(this).text();
				$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
			} );
			var table = $('#example').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{route('getdata')}}",
				"lengthChange": true,
				"lengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]],
				"columns": [
					{ "data": "first_name" },
            		{ "data": "last_name" },
					{ "data": 'email'},
					{ "data": 'address'},
				],
				dom: 'Blrtip',
				buttons: [
					'csv', 'excel',
				]
			});
			table.columns().every( function () {
				var that = this;
		
				$( 'input', this.footer() ).on( 'keyup change clear', function () {
					if ( that.search() !== this.value ) {
						that
							.search( this.value )
							.draw();
					}
				} );
			} );
		});
	</script>
@endsection
