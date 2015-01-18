function base_url()
{
	return "<?= base_url()?>";
}

function site_url(uri)
{
	return base_url()+"index.php/"+uri;
}