<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<?=$arResult["FORM_NOTE"]?>
<?if ($arResult["isFormNote"] != "Y")
{
?>

	<?=$arResult["FORM_HEADER"]?>
	<?
	if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
	{
	?>
		<div class="contact-form">
 			<div class="contact-form__head">
 				<?
				if ($arResult["isFormTitle"])
				{
				?>
					<div class="contact-form__head-title"><?=$arResult["FORM_TITLE"]?></div>
				<?
				} //endif ;
				if ($arResult["isFormImage"] == "Y")
				{
				?>
					<a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>"><img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<?elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" /></a>
				<?//=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
				<?
				} //endif
				?>
				<div class="contact-form__head-text"><?=$arResult["FORM_DESCRIPTION"]?></div>
			</div>
	<?
	} // endif
	?>

<br />

	<div class="contact-form__form-inputs">

		<?
		foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
		{
			if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
			{
				echo $arQuestion["HTML_CODE"];
			}
			else
			{
				$class = "input contact-form__input";

				if ($arQuestion['STRUCTURE'][0]['ID'] == 28){
					$class = "input";
				}
		?>	

			<div class="<?=$class?>">
				<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
				<span class="error-fld" title="<?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?>"></span>
				<?endif;?>
				<div class="input__label-text"><?=$arQuestion["CAPTION"]?></div>
				<?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
			<?	if ($arQuestion['STRUCTURE'][0]['ID'] != 28){
			?>
				<input class="input__input" <?=$arQuestion["HTML_CODE"];?> <br/>
			<?
			} else{
			?>
				<textarea class="input__input" <?=$arQuestion["HTML_CODE"];?> <br/>
			<?
			}?>
		</div>

		<?
			}
		} //endwhile
		?>
	</div>	

	<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>
	<?
	if($arResult["isUseCaptcha"] == "Y")
	{
	?>
		<b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b>
		<input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" />
		<?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?>
		<input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
	<?
	} // isUseCaptcha
	?>
	<div class="contact-form__bottom">
        <div class="contact-form__bottom-policy">Нажимая &laquo;Отправить&raquo;, Вы&nbsp;подтверждаете, что
                ознакомлены, полностью согласны и&nbsp;принимаете условия &laquo;Согласия на&nbsp;обработку персональных
                данных&raquo;.
        </div>
        <div class="form-button__title">
			<input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> class="form-button contact-form__bottom-button" data-success="Отправлено"
            data-error="Ошибка отправки" type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
			</div>
	</div>
</div>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>

