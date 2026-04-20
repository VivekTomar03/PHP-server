<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Outfit Designer</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/css/bootstrap-grid.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/css/fonts.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/css/designer.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
const OB_CONFIG = {
    base_url: '<?= base_url() ?>',
    host: 'localhost'
};
</script>
</head>
<body>

<!-- Required by designers-min.js -->
<div id="outfit-builder-anchor" class="loaded" style="display:none;"></div>

<section id="outfitDesigner" class="outfitDesigner">
	<div class="container-fluid-xl">
		<div class="row" id="outfit-designer">

			<!-- Left side controls -->
			<div class="col-12 col-md-7 col-lg-7">
				<div id="outfitDesignerMenu" class="newui">
					<?= view('outfits-interface', get_defined_vars()) ?>
				</div>
			</div>

			<div class="col-12 col-md-5 col-lg-4 offset-lg-1 text-center d-none d-md-block">
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
									<img src="<?= base_url() ?>assets/img/outfitdesigner/interface/sendtofriend.png" width="110" onerror="this.style.display='none'">
								</a>
							</div>
							<div style="margin-top:10px;">
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

<!-- modal send to a friend -->
<div class="modal fade" id="sendFriendModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body" style="padding:50px;">
				<h3>Send to a friend</h3>
				<p>Need a second opinion? Send the link below to your friends or family.</p>
				<div class="link-box">
					<input type="text" class="link" name="link" id="link">
					<a href="#" class="copy-paste">Copy</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url() ?>assets/js/mccalls.js"></script>
<script src="<?= base_url() ?>assets/js/designers-min.js"></script>
</body>
</html>
