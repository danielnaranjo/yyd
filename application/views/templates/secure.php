<?php
	if ($this->session->userdata('logged_in') == FALSE && $this->session->userdata('level')!=0) {
	    redirect(site_url().'?msg=Por+favor+verifica+los+datos+de+acceso&secure='.time(), 'refresh');
	}
?>
<script>
	console.debug('usedata',<?php echo json_encode($this->session->userdata)?>)
</script>