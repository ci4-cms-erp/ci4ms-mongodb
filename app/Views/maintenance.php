<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <title>CodePen - Maintenance page</title>
=======
    <title>Maintenance page</title>
>>>>>>> dev
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="<?=site_url('maintenance/style.css') ?>">
</head>
<body>
<!-- partial:index.partial.html -->
<div class="maintenance">
    <div class="maintenance_contain">
        <img src="<?=site_url('maintenance/main-vector.png')?>" alt="maintenance">
        <span class="pp-infobox-title-prefix">WE ARE COMING SOON</span>
        <div class="pp-infobox-title-wrapper">
            <h3 class="pp-infobox-title">The website under maintenance!</h3>
        </div>
        <div class="pp-infobox-description">
            <p>Someone has kidnapped our site. We are negotiation ransom and<br>will resolve this issue in 24/7 hours</p>			</div>
        <span class="title-text pp-primary-title">We are social</span>
        <div class="pp-social-icons pp-social-icons-center pp-responsive-center">
<<<<<<< HEAD
	<span class="pp-social-icon">
		<link itemprop="url" href="#">
		<a itemprop="sameAs" href="#" target="_blank" title="Facebook" aria-label="Facebook" role="button">
			<i class="fa fa-facebook"></i>
		</a>
	</span>
            <span class="pp-social-icon">
		<link itemprop="url" href="#">
		<a itemprop="sameAs" href="#" target="_blank" title="Twitter" aria-label="Twitter" role="button">
			<i class="fa fa-twitter"></i>
		</a>
	</span>
            <span class="pp-social-icon">
		<link itemprop="url" href="#">
		<a itemprop="sameAs" href="#" target="_blank" title="Google Plus" aria-label="Google Plus" role="button">
			<i class="fa fa-google-plus"></i>
		</a>
	</span>
            <span class="pp-social-icon">
		<a itemprop="sameAs" href="#" target="_blank" title="LinkedIn" aria-label="LinkedIn" role="button">
			<i class="fa fa-linkedin"></i>
		</a>
	</span>
=======
            <?php if(!empty($settings->socialNetwork)):
                foreach($settings->socialNetwork as $sn):?>
	<span class="pp-social-icon">
		<link itemprop="url" href="#">
		<a itemprop="sameAs" href="<?=$sn->link?>" target="_blank" title="<?=$sn->smName?>" aria-label="<?=$sn->smName?>" role="button">
			<i class="fa fa-<?=$sn->smName?>"></i>
		</a>
	</span>
            <?php endforeach; endif; ?>
>>>>>>> dev
        </div>
    </div>
</div>
<!-- partial -->

</body>
</html>
