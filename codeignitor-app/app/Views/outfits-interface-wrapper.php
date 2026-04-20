<section id="outfitDesigner" class="outfitDesigner">
	<div class="container-fluid-xl">
		<div class="row" id="outfit-designer">

			<!-- Left side controls -->
			<div class="col-12 col-md-7 col-lg-7">
				<div id="outfitDesignerMenu" class="newui"></div>
			</div>

			<div class="col-12 col-md-5 col-lg-4 offset-lg-1 text-center d-none d-md-block  ">
				<div id="previewWrapper">
					<div class="preview_container">
						<div class="info-toggle active d-sm-none d-md-block md-displayblock"></div>
						<div class="info-container d-sm-none d-md-block md-displayblock">
							<div class="icon-info"></div>
							<div class="outfit-info"></div>
							<div class="zoomout d-none"></div>
						</div>

						<!-- model preview -->
						<div id="previewimage"></div>

						<div class="mt-25 text-left customcodeWrapper">
							<div>
								<strong>This outfit's code is:</strong>
								<a href="#" data-toggle="modal" data-target="#sendFriendModal">
									<img src="<?= base_url() ?>assets/img/outfitdesigner/interface/sendtofriend.png" width="110">
								</a>
							</div>
							<div style="margin-top: 10px;">
								<span class="customcode"></span>
							</div>
						</div>

						<div class="codeContainer">
							<input type="text" name="savecode" class="savecode" placeholder="Got a code? Enter here">
							<button type="button" class="submitcode">Load</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<!-- Modal -->
<!--<div class="modal fade" id="sendEnquiryModal" tabindex="-1" role="dialog" aria-labelledby="sendEnquiryLabel" aria-hidden="true" style="display: none">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-body" style='padding:50px;'>
   			<h3>Send enquiry to McCalls</h3>
			<p>For more information or to hire this outfit, please fill out the details below. Please note your selected outfit will be sent to us along with your enquiry.</p>
			<div class="form-wrapper">

      		</div>
       </div>
  	</div>
</div>-->

<!-- modal send to a fiend -->
<div class="modal fade" id="sendFriendModal" tabindex="-1" role="dialog" aria-labelledby="sendFriendModalLabel" aria-hidden="true">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="modal-body" style='padding:50px;'>
				<h3>Send to a friend</h3>
				<p>Need a second opinion? Send the link below to your friends or family.</p>
				<div class="link-box">
					<input type="text" class="link" name="link" id="link">
					<a href="#" class="copy-paste">Copy</a>
					<!-- https://www.mccalls.co.uk/pages/outfit-builder/#ref=$outfitcode -->
				</div>
			</div>
		</div>
	</div>
</div>