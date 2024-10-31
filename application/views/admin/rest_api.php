<div class="pg-screen-container">
    <div class="pg-page-title-head">
        <h3>Rest API </h3>
    </div>
    <div class="pg-content-wrapper rest-api-wrapper">
	<form class="form" enctype="multipart/form-data" method="post">                
		<div class="row">                                                
			<div class="col-lg-12">
				<div class="pg-page-title-head">
					<h3>Get Template API </h3>
				</div>                        
			</div> 
		</div>              
	</form>
	<div class="pg-api-note-wrapper">
		
	</div>
	
	<div class="pg-api-info-wrap">
		<h4>		
            Note : You can use API from here to show templates on any third party side. You can use API, in any way as provided in the example 
		</h4>

	</div>
    <br>
	<div class="pg-api-info-wrap">
		<div class="pg-title-has-btn">
		    <h4>		
			    API URL
    		</h4>
            <button data="<?=base_url().'user-template';?>" type="button" class="ant-btn ant-btn-link ant-btn-sm copy-url dataCopy"><span role="img" aria-label="copy code snippet" class="anticon anticon-copy"><svg viewBox="64 64 896 896" focusable="false" data-icon="copy" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M832 64H296c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h496v688c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8V96c0-17.7-14.3-32-32-32zM704 192H192c-17.7 0-32 14.3-32 32v530.7c0 8.5 3.4 16.6 9.4 22.6l173.3 173.3c2.2 2.2 4.7 4 7.4 5.5v1.9h4.2c3.5 1.3 7.2 2 11 2H704c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32zM350 856.2L263.9 770H350v86.2zM664 888H414V746c0-22.1-17.9-40-40-40H232V264h432v624z"></path></svg></span><span>Copy Code</span></button>
		</div>
		<p>
			<?=base_url().'user-template';?>
		</p>        
        <br>
        <div class="pg-title-has-btn">
            <h4>		
                Token
    		</h4>	
            <button type="button" data="<?=isset($token) ? $token : '';?>" class="ant-btn ant-btn-link ant-btn-sm copy-token dataCopy"><span role="img" aria-label="copy code snippet" class="anticon anticon-copy"><svg viewBox="64 64 896 896" focusable="false" data-icon="copy" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M832 64H296c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h496v688c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8V96c0-17.7-14.3-32-32-32zM704 192H192c-17.7 0-32 14.3-32 32v530.7c0 8.5 3.4 16.6 9.4 22.6l173.3 173.3c2.2 2.2 4.7 4 7.4 5.5v1.9h4.2c3.5 1.3 7.2 2 11 2H704c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32zM350 856.2L263.9 770H350v86.2zM664 888H414V746c0-22.1-17.9-40-40-40H232V264h432v624z"></path></svg></span><span>Copy Code</span></button>	
	    </div>
        <p>
			<b>Token :</b> <?=isset($token) ? $token : '';?>
		</p>
		<div class="pg-title-has-btn">
		    <h4>		
    			Required Post Parameters
    		</h4>
            <button type="button" data="'length','start','search'" class="ant-btn ant-btn-link ant-btn-sm copy-paramiter dataCopy"><span role="img" aria-label="copy code snippet" class="anticon anticon-copy"><svg viewBox="64 64 896 896" focusable="false" data-icon="copy" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M832 64H296c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h496v688c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8V96c0-17.7-14.3-32-32-32zM704 192H192c-17.7 0-32 14.3-32 32v530.7c0 8.5 3.4 16.6 9.4 22.6l173.3 173.3c2.2 2.2 4.7 4 7.4 5.5v1.9h4.2c3.5 1.3 7.2 2 11 2H704c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32zM350 856.2L263.9 770H350v86.2zM664 888H414V746c0-22.1-17.9-40-40-40H232V264h432v624z"></path></svg></span><span>Copy Code</span></button>
		</div>
		<code>
    		<p>
    			<b>length :</b> 10
    		</p>
    		<p>
    			<b>start :</b> 0
    		</p>
    		<p>
    			<b>search :</b> 
    		</p>
		</code>
	</div>
    <br>
    <br>
	<div class="pg-api-info-wrap">
	    <div class="pg-title-has-btn">
    		<h4>		
    			Example Php Curl
    		</h4>	
    	</div>
		<div class="copy-php-curl-code d-none">
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, '<?=base_url().'user-template';?>');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            $post = array(
                'token' => '\"<?=isset($token) ? $token : '';?>\"',
                'length' => '\"10\"',
                'start' => '\"0\"',
                'search' => '\"\"'
            );
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

            $headers = array();
            $headers[] = 'Cookie: ci_session=cutmpc2qlh2ba4bgkv5umk0j1kd3k2s3';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
        </div>
        <br>
        <div class="pg-title-has-btn">
    		<h4>		
                Php Curl Code is Here
    		</h4>
    		<button type="button"  class="ant-btn ant-btn-link ant-btn-sm php-curl-code-copy"><span role="img" aria-label="copy code snippet" class="anticon anticon-copy"><svg viewBox="64 64 896 896" focusable="false" data-icon="copy" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M832 64H296c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h496v688c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8V96c0-17.7-14.3-32-32-32zM704 192H192c-17.7 0-32 14.3-32 32v530.7c0 8.5 3.4 16.6 9.4 22.6l173.3 173.3c2.2 2.2 4.7 4 7.4 5.5v1.9h4.2c3.5 1.3 7.2 2 11 2H704c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32zM350 856.2L263.9 770H350v86.2zM664 888H414V746c0-22.1-17.9-40-40-40H232V264h432v624z"></path></svg></span><span>Copy Code</span></button>
		</div>
		<code>
            <p>$ch = curl_init();</p>

            <p>curl_setopt($ch, CURLOPT_URL, '<?=base_url().'user-template';?>');</p>
            <p>curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);</p>
            <p>curl_setopt($ch, CURLOPT_POST, 1);</p>
            <p>$post = array(</p>
                <p>'token' => '\"<?=isset($token) ? $token : '';?>\"',</p>
                <p>'length' => '\"10\"',</p>
                <p>'start' => '\"0\"',</p>
                <p>'search' => '\"\"'</p>
            <p>);</p>
            <p>curl_setopt($ch, CURLOPT_POSTFIELDS, $post);</p>

            <p>$headers = array();</p>
            <p>$headers[] = 'Cookie: ci_session=cutmpc2qlh2ba4bgkv5umk0j1kd3k2s3';</p>
            <p>curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);</p>

            <p>$result = curl_exec($ch);</p>
            <p>if (curl_errno($ch)) {</p>
                <p>echo 'Error:' . curl_error($ch);</p>
            <p>}</p>
            <p>curl_close($ch);</p>
		</code>
		
		
	</div>
    <br>
    <br>
	<div class="pg-api-info-wrap">
	    <div class="pg-title-has-btn">
    		<h4>		
    			Curl
    		</h4>		
            
	    </div>
		<div class="copy-curl-code d-none">
            curl --location 'http://192.168.29.28/pixaguru/user-template' \
            --header 'Cookie: ci_session=cutmpc2qlh2ba4bgkv5umk0j1kd3k2s3' \
            --form 'token="MjBfcmF2aS5rdXNod2FoQHBpeGVsbnguY29t"' \
            --form 'length="10"' \
            --form 'start="0"' \
            --form 'search=""'
        </div>
        <br>	
        <div class="pg-title-has-btn">
    		<h4>	
                Curl Code is Here
    		</h4>
    		<button type="button" class="ant-btn ant-btn-link ant-btn-sm curl-code-copy"><span role="img" aria-label="copy code snippet" class="anticon anticon-copy"><svg viewBox="64 64 896 896" focusable="false" data-icon="copy" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M832 64H296c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h496v688c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8V96c0-17.7-14.3-32-32-32zM704 192H192c-17.7 0-32 14.3-32 32v530.7c0 8.5 3.4 16.6 9.4 22.6l173.3 173.3c2.2 2.2 4.7 4 7.4 5.5v1.9h4.2c3.5 1.3 7.2 2 11 2H704c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32zM350 856.2L263.9 770H350v86.2zM664 888H414V746c0-22.1-17.9-40-40-40H232V264h432v624z"></path></svg></span><span>Copy Code</span></button>		
    	</div>
		<code>
            <p>curl --location 'http://192.168.29.28/pixaguru/user-template' \</p>
            <p>--header 'Cookie: ci_session=cutmpc2qlh2ba4bgkv5umk0j1kd3k2s3' \</p>
            <p>--form 'token="MjBfcmF2aS5rdXNod2FoQHBpeGVsbnguY29t"' \</p>
            <p>--form 'length="10"' \</p>
            <p>--form 'start="0"' \</p>
            <p>--form 'search=""'</p>
		</code>
		
		
	</div>
	
	
</div>
</div>