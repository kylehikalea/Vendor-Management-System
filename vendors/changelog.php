<?php
include ('resources/header.php');

?>
<div class="container content">
	<div class="row">
		<div class="col-md-8">
			<h2>Changelog / Roadmap</h2>
		</div>
		<div class="col-md-4">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#suggestionModal" style="float: right;">
			  Have A Suggestion?
			</button>
		</div>
	</div>
	<h3>In-Progress Release Schedule</h3>
	<div class="row">
		<div class="col-md-2">
		ETA 12/12/2014
		</div>
		<div class="col-md-2">
		Version 0.9
		</div>
		<div class="col-md-8">
			<ul>
				<li>Sync existing approved products to Shop page.</li>
				<li>Create and join vendor groups.</li>
				<li>Upload multiple product pictures per individual product.</li>
				<li>View / edit previously approved products for quicker input times.</li>
				<li>View / edit existing coupons via application.</li>
			</ul>
		</div>
	</div>
	<h3>Previously Committed Changes</h3>
	<div class="row">
		<div class="col-md-2">
		12/05/2014
		</div>
		<div class="col-md-2">
		Bug Fix
		</div>
		<div class="col-md-8">
		Dashboard notifications panel will now properly display alerts from your inbox.
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
		12/05/2014
		</div>
		<div class="col-md-2">
		Improvement
		</div>
		<div class="col-md-8">
		Inbox has been added for sending / receiving of messages between vendors. You will also receive messages from staff in the Inbox.
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
		12/04/2014
		</div>
		<div class="col-md-2">
		Improvement
		</div>
		<div class="col-md-8">
		Personal information now editable from Manage Account button on Dashboard.
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
		12/04/2014
		</div>
		<div class="col-md-2">
		Bug Fix
		</div>
		<div class="col-md-8">
		Personal information fields now properly submitting to MySQL database upon new vendor creation.
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
		12/04/2014
		</div>
		<div class="col-md-2">
		Improvement
		</div>
		<div class="col-md-8">
		Added initial sales reporting functionality as line graph to dashboard.php.
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
		12/04/2014
		</div>
		<div class="col-md-2">
		Improvement
		</div>
		<div class="col-md-8">
		Alterations to dashboard.php, including latest vendor news and a notifications panel.
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
		12/03/2014
		</div>
		<div class="col-md-2">
		Improvement
		</div>
		<div class="col-md-8">
		Added pagenation, sortable and searchable fields to pages with high data volume, including view_pending_products.php and view_processed_products.php
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
		12/03/2014
		</div>
		<div class="col-md-2">
		Bug Fix
		</div>
		<div class="col-md-8">
		Redirect on login changed from view_pending_products.php to dashboard.php
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
		12/03/2014
		</div>
		<div class="col-md-2">
		Improvement
		</div>
		<div class="col-md-8">
		Addition of the vendor dashboard, emphasizing pending changes to products, coupons, events and messages.
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
		12/02/2014
		</div>
		<div class="col-md-2">
		Bug Fix
		</div>
		<div class="col-md-8">
		All data-sets are now translating correctly between pending_products.xml and approved_products.xml.
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
		12/02/2014
		</div>
		<div class="col-md-2">
		Bug Fix
		</div>
		<div class="col-md-8">
		Vendors can now properly edit pending products.
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
		12/01/2014
		</div>
		<div class="col-md-2">
		Improvement
		</div>
		<div class="col-md-8">
		'Make a Suggestion' tab and form added to the application changelog.
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
		12/01/2014
		</div>
		<div class="col-md-2">
		Improvement
		</div>
		<div class="col-md-8">
		Add application changelog to reflect repository updates and application improvements / bug-fixes.
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
		12/01/2014
		</div>
		<div class="col-md-2">
		Improvement
		</div>
		<div class="col-md-8">
		Product creation now includes a 'type' field to differentiate products beyond the description.
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
		11/28/2014
		</div>
		<div class="col-md-2">
		Systems
		</div>
		<div class="col-md-8">
		File systems moved to GitHub repository for collaboration and version control purposes.
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
		11/26/2014
		</div>
		<div class="col-md-2">
		Improvement
		</div>
		<div class="col-md-8">
		Products images may now be replaced / removed after creation via the vendors 'edit' panel.
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
		11/25/2014
		</div>
		<div class="col-md-2">
		Improvement
		</div>
		<div class="col-md-8">
		All required fields will no longer be accepted unless filled out properly.
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
		11/25/2014
		</div>
		<div class="col-md-2">
		Release
		</div>
		<div class="col-md-8">
		Release of version 0.80
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="suggestionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">Request A Change</h4>
		  </div>
		  <div class="modal-body">
			<p>Notice a bug? Have a suggestion? Use the form below to send us a change / feature request!</p>
			<textarea class="form-control" rows="3"></textarea>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			<button type="button" class="btn btn-primary">Submit Request(s)</button>
		  </div>
		</div>
	  </div>
	</div>
</div>
<?php
include('resources/footer.php');
?>