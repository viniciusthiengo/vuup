<!doctype html>
<html lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="keywords" content="vuup" />
		<meta name="description" content="" />
		<meta property="og:image" content="" />
		
		<title>Busca</title>
		
		<!-- start CSS -->
			<?php
				require_once(__PATH__.'/view/head/css.php');
				require_once(__PATH__.'/view/head/analyticstracking.php');
			?>
		<!-- end CSS -->
	</head>
	
	
	
	<body>
		<!-- HEADER -->
			<?php
				require_once(__PATH__.'/view/head/top.php');
			?>
		<!-- HEADER -->
		
		
		
		
		
		<!-- HEADER INDEX (SLIDE) -->
			<section class="header-index box-search">
				<div class="container">
					<form id="form-search-event" class="form br-3">
						<input type="search" class="br-3" id="fse-search" placeholder="Buscar" />
					
						<select id="fse-category" class="br-3">
							<option value="0">Todas as categorias</option>
							<option value="1">Congresso, seminário</option>
							<option value="2">Culinária</option>
							<option value="3">Curso, workshop</option>
							<option value="4">Encontro, networking</option>
							<option value="5">Esportivo</option>
							<option value="6">Feira, exposição</option>
							<option value="7">Religioso</option>
							<option value="8">Show, música e festa</option>
						</select>
					
						<select id="fse-state" class="br-3">
							<?php
								echo $optionState->getOptions();
							?>
						</select>
						
						<select id="fse-city" class="br-3">
							<option value="0">Cidade</option>
						</select>
						
						<input type="text" class="br-3" id="fse-date-start" placeholder="De:" />
						<input type="text" class="br-3" id="fse-date-end" placeholder="Até:" />
						
						<div class="box-type-event">
							<label title="Somente eventos gratuitos">
								<input type="checkbox" id="fse-only-free" value="1" />
								Somente gratuitos
							</label>
							<label title="Somente eventos pagos">
								<input type="checkbox" id="fse-only-payment" value="1" />
								Somente pagos
							</label>
							<label title="Somente eventos online">
								<input type="checkbox" id="fse-only-online" value="1" />
								Somente online
							</label>
						</div>
					</form>
				</div>
			</section>
		<!-- HEADER INDEX (SLIDE) -->
		
		
		
		
		
		<!-- MAIN -->
			<main>
				<div class="box-events">
					<?php
						require_once(__PATH__.'/view/events.php');
					?>
				</div>
			</main>
		<!-- MAIN -->
		
		
		
		
		

		
		<!-- start FOOTER -->
			<?php
				require_once(__PATH__.'/view/footer/footer.php');
				require_once(__PATH__.'/view/footer/js.php');
			?>
		<!-- end FOOTER -->
	</body>
</html>