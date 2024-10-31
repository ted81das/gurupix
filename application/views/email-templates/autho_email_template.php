<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Pixaguru</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body style="margin:0;font-family: 'Roboto', sans-serif;line-height: 26px;">
	<table cellpadding="0" cellspacing="0" border="0" style="background-color:#ffffff; font-family: 'Nunito Sans', sans-serif; width:100%;">
		<tr>
			<td>
				<table cellpadding="0" cellspacing="0" border="0l" style="padding: 95px 30px;width: 600px;margin:0 auto;">
					<tr>
						<td style="clear: both !important;background-color:#f7f8fa; border-radius: 20px 20px 33px 33px;overflow: hidden;">
							<!-- Global Header Logo  -->
						    <table align="center" cellpadding="0" cellspacing="0" border="0" style="width: 100%; border: none;border: none;">
								<tr style="-webkit-font-smoothing: antialiased;  height: 100%;  -webkit-text-size-adjust: none;  width: 100% !important;">
									<td align="center" style=" float: left; padding: 50px 0px 40px;text-align: center;width:100%;background-image: url(<?= base_url(); ?>assets/images/email-header-img.png); background-size: cover;background-position: center bottom;">
										<span style="padding-right: 10px;text-align: center;display:inline-block;">
											<img src="<?= base_url(); ?>assets/images/logo-light.png" />
										</span>
									</td>
								</tr>
							</table>
							<!-- Main Table  -->
							<table cellpadding="0" cellspacing="0" border="0" style=" width: 100%; padding:40px 25px 24px;text-align:left;">
								<!-- Title  -->
								<tr>
									<td style="font-size:20px; font-weight: 800; color:#232429;padding:0 25px;"><span>Hi</span> <span class="business-name"><?= !empty($name) ? $name : 'There'; ?></span>,</td>
								</tr>
								<!-- Update User  -->
								<?php if($email_for == 'update_user'){ ?>
								<tr>
									<td style="padding:0 25px;">
										<p style="white-space: normal;margin: 10px 0 0;font-size:16px;line-height: 1.8;color:#656a7c;">
											We have updated your Webtri account. We are glad to have you as a part of Webtri.
										</p>
										<p>
											Login with same credentials.<br>
											<a href="<?= base_url(); ?>"><?= base_url(); ?></a>
										</p>
									</td>
								</tr>
								
								<!-- New User  -->
								<?php }elseif($email_for == 'new_user'){ ?>
									<tr>
										<td style="padding:0 25px;">
											<div>
												<p style="white-space: normal;margin: 10px 0 0;font-size:16px;line-height: 1.8;color:#656a7c;">
													Your account is created successfully. You can access your account using following credentials:
												</p>
												<div style="margin:20px 0;padding: 20px 30px;background: #ffffff;border-radius: 10px;font-size: 15px;">
													<b>Login URL: </b> <?= base_url(); ?>
													<span style="display:block; height:10px;"></span>
													<b>Username: </b> <?= $email; ?>
													<span style="display:block; height:10px;"></span>
													<b>Password: </b> <?= $password; ?>
												</div>
											</div>
										</td>
									</tr>

								<!-- Reset User Info  -->
								<?php }elseif($email_for == 'password_reset'){ 
									
									
									?>
										<tr>
											<td style="padding:0 25px;">
												<p style="white-space: normal;margin: 10px 0 0;font-size:16px;line-height: 1.8;color:#656a7c;">
													Someone has requested a password reset for the following account. If this was a mistake, just ignore this email and nothing will happen.
												</p>
												<div style="margin:10px 0px; font-weight: 900;">OR</div>
												<p style="white-space: normal;margin: 0 0 0;font-size:16px;line-height: 1.8;color:#656a7c;">
													To reset your password, click the following link<br>
													<a href="<?= $RESET_LINK; ?>" style="font-size:15px; color:#1d3a6e;font-weight: 500;"><?= $RESET_LINK; ?></a>
												</p>
											</td>
										</tr>
								<?php } ?>
								

								<tr><td>
								<!-- <p>
									If you have any questions or doubts please contact us by sending email at: <a style="font-size: 15px;color: #08742a;font-weight: 700;"href="mailto:support@webtri.zohodesk.in">support@webtri.zohodesk.in</a>
								</p> -->
								</td></tr>
								
								<tr><td style="height:30px;"></td></tr>
							</table>
							<!-- Footer  -->
							<table class="foot-table" cellpadding="0" cellspacing="0" border="0" style="width: 100%; border-radius: 0px 0px 20px 20px;">
								<tr>
									<td style="margin: 0;padding:20px 0 20px;
									font-size: 16px;
									text-align: center;
									color: #ffffff;background: #ff467f;background: linear-gradient(to bottom left,rgb(255 102 149) 0%,rgb(236 64 122) 100%);
									font-weight: 600;">Copyright @ <?= date('Y'); ?> Webtri</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>