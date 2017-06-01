<?php
	$text = '';
	$categoryOptions = new EventCategory();
	$stateOptions = new State();
	$city = '';
	$startDate = '';
	$endDate = '';
	$onlyPayment = ' checked="chekced"';
	$onlyFree = ' checked="chekced"';
	
	if(is_object($search)){
		$text = $search->getText();
		$categoryOptions = is_object($search->getEventCategory()) ? $search->getEventCategory() : $categoryOptions;
		$stateOptions = is_object($search->getState()) ? $search->getState() : $stateOptions;
		$city = $search->getCity();
		$startDate = $search->getStartDate() > 0 ? date('d\/m\/Y', $search->getStartDate()) : '';
		$endDate = $search->getEndDate() > 0 ? date('d\/m\/Y', $search->getEndDate()) : '';
		$onlyPayment = $search->getOnlyPayment() == 1 ? ' checked="chekced"' : '';
		$onlyFree = $search->getOnlyFree() == 1 ? ' checked="chekced"' : '';
	}
?>
<form id="form-filter-search-event" class="form br-3" method="get" action="<?php echo __PATH_FOR_LONG_URL__; ?>busca">
	<div class="box-field">
		<input type="search" class="br-3" id="ffse-search" placeholder="Buscar" name="q" value="<?php echo $text; ?>" />
	</div>
	
	<div class="box-field">
		<select id="ffse-category" class="br-3" name="ec">
			<?php
				echo $categoryOptions->getOptions();
			?>
		</select>
	</div>
	
	<div class="box-field">
		<select id="ffse-state" class="br-3" name="s">
			<?php
				echo $stateOptions->getOptions();
			?>
		</select>
	</div>
	
	<div class="box-field">
		<input type="text" id="ffse-city" class="br-3" placeholder="Cidade" name="c" value="<?php echo $city; ?>" />
	</div>
	
	<div class="box-field">
		<input type="text" class="br-3" id="ffse-date-start" placeholder="De:" name="sd" value="<?php echo $startDate; ?>" />
		<input type="text" class="br-3" id="ffse-date-end" placeholder="Até:" name="ed" value="<?php echo $endDate; ?>" />
		<div class="cl"></div>
	</div>
	
	<div class="box-type-event box-field">
		<label title="Somente eventos gratuitos" class="br-3">
			<input type="checkbox" id="ffse-only-free" value="1" <?php echo $onlyFree; ?> name="of" />
			Somente eventos gratuitos
		</label>
		<label title="Somente eventos pagos" class="br-3">
			<input type="checkbox" id="ffse-only-payment" value="1" <?php echo $onlyPayment; ?> name="op" />
			Somente eventos pagos
		</label>
	</div>
	
	<input type="hidden" id="ffse-search-hidden" value="<?php echo $text; ?>" />
	<input type="hidden" id="ffse-category-hidden" value="<?php echo $categoryOptions->getItem(); ?>" />
	<input type="hidden" id="ffse-state-hidden" value="<?php echo $stateOptions->getItem(); ?>" />
	<input type="hidden" id="ffse-city-hidden" value="<?php echo $city; ?>" />
	<input type="hidden" id="ffse-date-start-hidden" value="<?php echo $startDate; ?>" />
	<input type="hidden" id="ffse-date-end-hidden" value="<?php echo $endDate; ?>" />
	<input type="hidden" id="ffse-only-free-hidden" value="<?php echo empty($onlyFree) ? '0' : '1'; ?>" />
	<input type="hidden" id="ffse-only-payment-hidden" value="<?php echo empty($onlyPayment) ? '0' : '1'; ?>" />
	<button id="ffse-button" class="bt-form br-3" title="Buscar" type="submit">
		<i class="fa fa-search"></i>
	</button>
</form>