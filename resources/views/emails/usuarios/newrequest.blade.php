@extends('emails.base')
@section('content')

<!-- template-2 -->
<table class="table_full editable-bg-color bg_color_ffffff editable-bg-image" bgcolor="#ffffff" width="100%" align="center"  mc:repeatable="castellab" mc:variant="Header" cellspacing="0" cellpadding="0" border="0" style="background-image: url(#); background-repeat: no-repeat; background-position: center left; background-size: 100% 100%; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" background="#">
	<!-- padding-top -->
	<tr><td height="100"></td></tr>

	<!-- header -->
	<tr>
		<td>
			<table class="table1" width="600" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td bgcolor="#fcfcfc" style="padding-top: 30px;padding-right: 40px;padding-bottom: 0;padding-left: 40px; border: 1px solid #f2f2f2; border-radius: 5px;">
						<!-- Logo -->
						<table class="no_float" align="left" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="editable-img" align="center">
									<a href="#">
										<img editable="true" class="centerize" mc:edit="image101" src="{!! asset('emails/images/bannercorreo.png') !!}" style="display:block; line-height:0; font-size:0; border:0;" border="0" alt="image" />
									</a>
								</td>
							</tr>
							<!-- margin-bottom -->
							<tr><td height="30"></td></tr>
						</table><!-- END logo -->

						
					</td>
				</tr>
			</table>
		</td>
	</tr><!-- END header -->

	<!-- horizontal gap -->
	<tr><td height="25"></td></tr>

	<!-- body -->
	<tr>
		<td>
			<table class="table1" width="600" align="center" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td bgcolor="#fcfcfc" style="padding: 40px 0;border: 1px solid #f2f2f2;border-radius: 5px;">
						<!-- body-container -->
						<table class="table1" width="480" align="center" border="0" cellspacing="0" cellpadding="0">

							<!-- email heading -->
							<tr>
								<td align="left" mc:edit="text101" class="text_color_282828" style="line-height: 1;color: #34495E; font-size: 37px; font-weight: 600; font-family: 'Open Sans', Helvetica, sans-serif; mso-line-height-rule: exactly;">
									<div class="editable-text">
										<span class="text_container">Nueva Solicitud de Estudio</span>
									</div>
								</td>
							</tr><!-- END email heading -->

							<!-- horizontal gap -->
							<tr><td height="20"></td></tr>

							<!-- email details -->
							<tr>
								<td align="left" mc:edit="text102" class="text_color_c6c6c6" style="line-height: 1.8;color: #000000; font-size: 20px; font-weight: 300; font-family: 'Open Sans', Helvetica, sans-serif; mso-line-height-rule: exactly;">
									<div class="editable-text">
										<span class="text_container">Hola <strong>Admin</strong>, solicitaron un nuevo estudio, aca los datos:</span><br>
										
						

                                        <p>Solicitante: <strong>{{$data["from"]}}</strong></p>
                                        <p>Email: <strong>{{$data["email"]}}</strong></p>
                                        <p>Estudio: <strong>{{$data["name"]}}</strong></p>
                                        <p>Año: <strong>{{$data["ano"]}}</strong></p>
                                        <p>Categoria: <strong>{{$data["categoria"]}}</strong></p>
                                        <p>Pais: <strong>{{$data["pais"]}}</strong></p>
                                        <p>Observaciones: <strong>{{$data["observaciones"]}}</strong></p>
                              
									</div>
								</td>
							</tr><!-- END email details -->
							
							<tr>
                                                      <td align="center" bgcolor="#34495E" role="presentation" style="font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; border: none; border-radius: 3px; cursor: auto; mso-padding-alt: 10px 25px; background: #34495E;" valign="middle"> <a href="https://sim-ep.com/login" style="display: inline-block; background: #34495E; color: #ffffff; font-family: Open Sans, Helvetica, Tahoma, Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 120%; margin: 0; text-decoration: none; text-transform: none; padding: 10px 25px; mso-padding-alt: 0px; border-radius: 3px;" target="_blank"> Ingresar</a> </td>
                                                   </tr>

							<!-- horizontal gap -->
							<tr><td height="40"></td></tr>

							

							

						

							

							<!-- horizontal gap -->
							<tr><td height="40"></td></tr>
							
							<!-- Unsubscribe link -->
							
						</table><!-- END body-container -->
					</td>
				</tr>
			</table>
		</td>
	</tr><!-- END body -->

	<!-- padding-bottom -->
	<tr><td height="100"></td></tr>
</table>

@endsection