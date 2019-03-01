<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Reservation</h1>
		</div>
	</div>
	<div class="row dash-icon">
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i  style="color:#FF8961;"class="fa fa-users fa-3x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?php echo count(@$salcount['sales']); ?></div>
							<div class="font-small">Sales Staff Panel</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer adi-head-orange">
						<span class="pull-left"><a href='panels/supermacdaddy/sales'>View Details</a></span>
						<span class="pull-right"><i class="fa fa-arrow-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i  style="color:#56BDDC;"class="fa fa-user fa-3x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge"><?php echo @$salcount['users']; ?></div>
							<div class="font-small">Certified Providers Panel</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer adi-head-blue">
						<span class="pull-left"><a href='#' class="" data-toggle="modal" data-target="#exampleModal">View Details</a></span>
						<span class="pull-right"><i class="fa fa-arrow-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i  style="color:#baa2e0;" class="fa fa-globe fa-3x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">124</div>
							<div class="font-small">Affiliate Partners Panel</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer adi-head-per">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i  style="color:#10B1AC;" class="fa fa-support fa-3x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">13</div>
							<div class="font-small">Support Tickets!</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer adi-head-green">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading title-bar-blue">
                    <p><i class="fa fa-users" aria-hidden="true"></i> Appointment Reservations</p>

                </div> <!-- /.panel-heading -->
				<div class="panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Patient Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Date</th>
								<th>Time</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr class="odd gradeX">
								<td>Trident</td>
								<td>Internet Explorer 4.0</td>
								<td>Win 95+</td>
								<td class="center">4</td>
								<td class="center">X</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
