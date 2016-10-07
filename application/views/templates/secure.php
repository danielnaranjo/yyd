<?php
/*
	if (isset($this->session->userdata['logged_in'])) {
	    $username = ($this->session->userdata['logged_in']['username']);
	    //$email = ($this->session->userdata['logged_in']['email']);
	} else {
	    header("location: ../");
	}
	*/
	if ($this->session->userdata('logged_in') == FALSE) {
	    redirect(site_url().'?msg=Por+favor+verifica+los+datos+de+acceso', 'refresh');
	}
?>
<script>
	console.debug('usedata',<?php echo json_encode($this->session->userdata)?>)
</script>