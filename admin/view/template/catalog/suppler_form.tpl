<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>			
			
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a><a href="#tab-data"><?php echo $tab_data; ?></a><a href="#tab-attribute"><?php echo $tab_attribute; ?></a><a href="#tab-option"><?php echo $tab_option; ?></a><a href="#tab-price"><?php echo $tab_price; ?></a><a href="#tab-seo"><?php echo $tab_seo; ?></a><a href="#tab-action"><?php echo $tab_action; ?></a></div>
	  
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <table class="form">
            <tr>
              <td><span class="required">* </span><?php echo $entry_name; ?></td>
              <td><input type="text" name="name" value="<?php echo $supplers['name']; ?>" maxlength="64" size="32" />
                <?php if ($error_name) { ?>
                <span class="error"><?php echo $error_name; ?></span>
                <?php } ?></td>
				<td width="200"><span class="required">* </span><?php echo $entry_suppler_id; ?></td>
				<td><input type="text" name="suppler_id" value="<?php if (isset($supplers['suppler_id'])) echo $supplers['suppler_id']; ?>" maxlength="2" size="2" title = "from 1 to 99"/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;				
				<?php echo $entry_suppler_main; ?>
				<?php if ($supplers['main']) { ?>
                <input type="checkbox" name="main" value="1" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="main" value="0"/>
                <?php } ?>
				</td>
				<td width="200"><span class="required">* </span><?php echo $entry_store; ?></td>
				<td><input type="text" name="addattr" value="<?php if (isset($supplers['addattr']) and $supplers['addattr'] > 0) echo $supplers['addattr']; else { $supplers['addattr'] = 0; echo '0'; }?>" maxlength="1" size="2" title = "Warning!  Page 'Data' will be cleared Осторожно! Страница 'Данные' будет утеряна" />
				</td>
            </tr>
            <tr style=" background: #EEEEEE;">
			  <td><?php echo $entry_rate; ?></td>
              <td><input type="text" name="rate" value="<?php echo $supplers['rate']; ?>" maxlength="13" size="12" /></td>
			  <td width="200"><?php echo $entry_ratep; ?></td>
              <td><input type="text" name="ratep" value="<?php echo $supplers['ratep']; ?>" maxlength="13" size="12" /></td>
			  <td width="200"><?php echo $entry_ratek; ?></td>
              <td><input type="text" name="ratek" value="<?php echo $supplers['ratek']; ?>" maxlength="13" size="12" /></td>
			</tr>
            <tr>	
			  <td><span class="required">* </span> <?php echo $entry_cod; ?><br /><br />
			  <?php echo $entry_pars; ?></td>  
			  <td><input type="text" name="cod" value="<?php echo $supplers['cod']; ?>" maxlength="128" size="32" title = "e.g.  prod_code&gt;,&lt;/p"/>
			  <br/><br/><br/><input type="text" name="parss" value="<?php if (isset($supplers['parss'])) echo $supplers['parss']; ?>" maxlength="4" size="4" /></td>
			  <td width="200"><?php echo $entry_point1; ?><br/><br/><br/><?php echo $entry_place; ?></td>
			 <td><input type="text" name="points" value="<?php echo $supplers['points']; ?>" maxlength="64" size="32" title = "e.g. class=&quot;product_param&quot;&gt;"/><br /><br /><br /><input type="text" name="places" value="<?php if (isset($supplers['places'])) echo $supplers['places']; ?>" maxlength="4" size="4" title = "1 - by default"/></td>			
			  <td width="200"><?php echo $entry_sku2; ?><br/><br/>
			  <?php echo $entry_stay; ?><br/><br/>
			  <?php echo $entry_joen; ?>
			  </td>  
			  <td><input type="text" name="sku2" value="<?php echo $supplers['sku2']; ?>" maxlength="9" size="12" /><br/><br/>
			  <?php if (isset($supplers['stay']) and $supplers['stay']) { ?>
                <input type="radio" name="stay" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="stay" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="stay" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="stay" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?>
				<br/><br/>
				<select name="joen">
                 <?php if(isset($supplers['joen']) and $supplers['joen'] == 0) { ?>		
                  <option value="0" selected="selected"> <?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $text_no; ?></option>
                  <?php } ?>
			      <?php if(isset($supplers['joen']) and $supplers['joen'] == 1) { ?>		
                  <option value="1" selected="selected"> <?php echo $entry_joen1; ?></option>
                  <?php } else { ?>
                  <option value="1"> <?php echo $entry_joen1; ?></option>
                  <?php } ?>
                  <?php if(isset($supplers['joen']) and $supplers['joen'] == 2) { ?>		
                  <option value="2" selected="selected"><?php echo $entry_joen2; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $entry_joen2; ?></option>
                  <?php } ?>
				</select>  
			  </td>			 
			</tr>
			<tr style=" background: #EEEEEE;">
			  <td>* <?php echo $entry_item; ?><br/><br/>
			  <?php echo $entry_pars; ?></td>
              <td><input type="text" name="item" value="<?php echo $supplers['item']; ?>" maxlength="128" size="32" title = "e.g. title&gt;,&lt;/tit"/>
			  <br/><br/><br/><input type="text" name="parsi" value="<?php if (isset($supplers['parsi'])) echo $supplers['parsi']; ?>" maxlength="4" size="4"/></td>
			  <td width="200"><?php echo $entry_point1; ?><br/><br/><br/><?php echo $entry_place; ?></td>
			 <td><input type="text" name="pointi" value="<?php echo $supplers['pointi']; ?>" maxlength="64" size="32" title = "e.g. head"/><br/><br/><br/><input type="text" name="placei" value="<?php if (isset($supplers['placei'])) echo $supplers['placei']; ?>" maxlength="4" size="4" title = "1 - by default" /></td>		
		     <td width="200">
				<?php echo $entry_upname; ?></td>
			  <td>	
                <?php if (isset($supplers['upname']) and $supplers['upname']) { ?>
                <input type="radio" name="upname" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="upname" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="upname" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="upname" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?></td>		
			 </tr>			 
			<tr>
			  <td>* <?php echo $entry_cat; ?><br/><br/>
			  <?php echo $entry_pars; ?></td>
              <td><input type="text" name="cat" value="<?php if (isset($supplers['cat'])) echo $supplers['cat']; ?>" maxlength="128" size="32" title = "e.g. 'category=,&" /><br/><br/><br/><input type="text" name="parsc" value="<?php echo $supplers['parsc']; ?>" maxlength="4" size="4"/></td>
			  <td width="200"><?php echo $entry_point1; ?><br/><br/><br/><?php echo $entry_place; ?></td>
			 <td><input type="text" name="pointc" value="<?php echo $supplers['pointc']; ?>" maxlength="64" size="32" title = "e.g. function slot_go(value)" /><br/><br/><br/><input type="text" name="placec" value="<?php if (isset($supplers['placec'])) echo $supplers['placec']; ?>" maxlength="4" size="4" title = "1 - by default" /></td>	  
              <td width="200"><br /><?php echo $entry_mycat; ?><br/><br/><br/><?php echo $entry_parent; ?></td>
			  <td><br />			  
              <select name="my_cat">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($categories as $category) { ?>
                  <?php if(isset($my_cat) and $category['category_id'] == $my_cat) { ?>			
                  <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>			
				<br /><br /><br />
                <select name="parent">
				  <?php if(isset($supplers['parent']) and $supplers['parent'] == 0) { ?>
                  <option value="0" style="color: #DE1A1A;" selected="selected"> <?php echo $entry_parent0; ?></option>
                  <?php } else { ?>
                  <option value="0" style="color: #DE1A1A;"> <?php echo $entry_parent0; ?></option>
                  <?php } ?>
				  <?php if(isset($supplers['parent']) and $supplers['parent'] == 1) { ?>
                  <option value="1" style="color: #DE1A1A;" selected="selected"> <?php echo $entry_parent1; ?></option>
                  <?php } else { ?>
                  <option value="1" style="color: #DE1A1A;"> <?php echo $entry_parent1; ?></option>
                  <?php } ?>
				  <?php if(isset($supplers['parent']) and $supplers['parent'] == 2) { ?>
                  <option value="2" style="color: #DE1A1A;" selected="selected"> <?php echo $entry_parent2; ?></option>
                  <?php } else { ?>
                  <option value="2" style="color: #DE1A1A;"> <?php echo $entry_parent2; ?></option>
                  <?php } ?>
				  <?php if(isset($supplers['parent']) and $supplers['parent'] == 3) { ?>			
                  <option value="3" style="color: #DE1A1A;" selected="selected"><?php echo $entry_parent3; ?></option>
                  <?php } else { ?>
                  <option value="3" style="color: #DE1A1A;"><?php echo $entry_parent3; ?></option>
                  <?php } ?>
                  <?php if(isset($supplers['parent']) and $supplers['parent'] == 4) { ?>			
                  <option value="4" style="color: #0CC72A;" selected="selected"><?php echo $entry_parent4; ?></option>
                  <?php } else { ?>
                  <option value="4" style="color: #0CC72A;"><?php echo $entry_parent4; ?></option>
                  <?php } ?>
				  <?php if(isset($supplers['parent']) and $supplers['parent'] == 5) { ?>			
                  <option value="5" style="color: #0CC72A;" selected="selected"><?php echo $entry_parent5; ?></option>
                  <?php } else { ?>
                  <option value="5" style="color: #0CC72A;"><?php echo $entry_parent5; ?></option>
                  <?php } ?>
				  <?php if(isset($supplers['parent']) and $supplers['parent'] == 6) { ?>			
                  <option value="6" style="color: #0CC72A;" selected="selected"><?php echo $entry_parent6; ?></option>
                  <?php } else { ?>
                  <option value="6" style="color: #0CC72A;"><?php echo $entry_parent6; ?></option>
                  <?php } ?>
				</select>  
			</tr>
			
			<tr style=" background: #EEEEEE;">
			  <td><span class="required">* </span><?php echo $entry_qu; ?><br/><br/><br/>
			  <?php echo $entry_pars; ?></td>
              <td><input type="text" name="qu" value="<?php echo $supplers['qu']; ?>" maxlength="128" size="32" /><br/><br/><br/><br/><input type="text" name="parsq" value="<?php echo $supplers['parsq']; ?>" maxlength="4" size="4"/></td>
			  <td width="200"><?php echo $entry_point1; ?><br/><br/><br/><?php echo $entry_place; ?></td>
			 <td><input type="text" name="pointq" value="<?php echo $supplers['pointq']; ?>" maxlength="64" size="32" title = "e.g. function slot_go(value)" /><br/><br/><br/><br/><input type="text" name="placeq" value="<?php if (isset($supplers['placeq'])) echo $supplers['placeq']; ?>" maxlength="4" size="4" title = "1 - by default" /></td>
			  <td width="200"><?php echo $entry_qu_discount; ?><br /><br/><?php echo $entry_minus; ?><br /><br/>
			  <?php echo $entry_myqu; ?>
			  <td>
				<input type="text" name="qu_discount" value="<?php echo $supplers['qu_discount']; ?>" maxlength="128" size="32" /><br/><br/>
                <?php if ($supplers['minus']) { ?>
                <input type="radio" name="minus" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="minus" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="minus" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="minus" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?><br/><br/>
				<input type="text" name="my_qu" value="<?php echo $supplers['my_qu']; ?>" maxlength="128" size="52" title = "e.g. 10-50=20,+=10,++=20,Нет=0,нет=0,Есть=5" />
				</td>			  
            </tr>			
			<tr>
			  <td><span class="required">*</span> <?php echo $entry_price; ?><br/><br/>
			  <?php echo $entry_pars; ?><br/><br/><?php echo $entry_iprice; ?><br/><br/><?php echo $entry_usd; ?></td>
              <td><input type="text" name="price" value="<?php if (isset($supplers['price'])) echo $supplers['price']; ?>" maxlength="128" size="32"  title = "e.g. &lt;/div&gt;&lt;div class=&quot;total-price&quot;&gt;,&lt;/" /><br/><br/><br/><input type="text" name="parsp" value="<?php echo $supplers['parsp']; ?>" maxlength="4" size="4"/><br/><br/><br/>
			  <input type="text" name="bprice" value="<?php if (isset($supplers['bprice'])) echo $supplers['bprice']; ?>" maxlength="4" size="12" />
			  <br/><br/><br/><input type="text" name="usd" value="<?php echo $supplers['usd']; ?>" maxlength="4" size="4"/>
			  </td>
			  <td width="200"><?php echo $entry_point1; ?><br/><br/><br/><?php echo $entry_placep; ?><br/><br/><br/><?php echo $entry_myprice;?></td>
			 <td><input type="text" name="pointp" value="<?php echo $supplers['pointp']; ?>" maxlength="64" size="32" title = "e.g. function slot_go(value)" /><br/><br/><br/><br/>
			 <select name="placep">
				 <?php if(isset($placep) and $placep == 0) { ?>		
                  <option value="0" selected="selected"> <?php echo $entry_placep0; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $entry_placep0; ?></option>
                  <?php } ?>
			      <?php if(isset($placep) and $placep == 1) { ?>		
                  <option value="1" selected="selected"> <?php echo $entry_placep1; ?></option>
                  <?php } else { ?>
                  <option value="1"> <?php echo $entry_placep1; ?></option>
                  <?php } ?>
                  <?php if(isset($placep) and $placep == 2) { ?>		
                  <option value="2" selected="selected"><?php echo $entry_placep2; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $entry_placep2; ?></option>
                  <?php } ?>
				  <?php if(isset($placep) and $placep == 3) { ?>		
                  <option value="3" selected="selected"><?php echo $entry_placep3; ?></option>
                  <?php } else { ?>
                  <option value="3"><?php echo $entry_placep3; ?></option>
                  <?php } ?>
				  <?php if(isset($placep) and $placep == 4) { ?>		
                  <option value="4" selected="selected"><?php echo $entry_placep4; ?></option>
                  <?php } else { ?>
                  <option value="4"><?php echo $entry_placep4; ?></option>
                  <?php } ?>
				  <?php if(isset($placep) and $placep == 5) { ?>		
                  <option value="5" selected="selected"><?php echo $entry_placep5; ?></option>
                  <?php } else { ?>
                  <option value="5"><?php echo $entry_placep5; ?></option>
                  <?php } ?>
				  <?php if(isset($placep) and $placep == 6) { ?>		
                  <option value="6" selected="selected"><?php echo $entry_placep6; ?></option>
                  <?php } else { ?>
                  <option value="6"><?php echo $entry_placep6; ?></option>
                  <?php } ?>
                </select><br/><br/><br/>
			<select name="my_price">
			      <?php if(isset($my_price) and $my_price == 1) { ?>			
                  <option value="1" selected="selected"> <?php echo $text_myprice1; ?></option>
                  <?php } else { ?>
                  <option value="1" > <?php echo $text_myprice1; ?></option>
                  <?php } ?>
                  <?php if(isset($my_price) and $my_price == 2) { ?>			
                  <option value="2" selected="selected"><?php echo $text_myprice2; ?></option>
                  <?php } else { ?>
                  <option value="2" ><?php echo $text_myprice2; ?></option>
                  <?php } ?>
				  <?php if(isset($my_price) and $my_price == 3) { ?>			
                  <option value="3" selected="selected"><?php echo $text_myprice3; ?></option>
                  <?php } else { ?>
                  <option value="3" ><?php echo $text_myprice3; ?></option>
                  <?php } ?>
				  <?php if(isset($my_price) and $my_price == 4) { ?>			
                  <option value="4" selected="selected"><?php echo $text_myprice4; ?></option>
                  <?php } else { ?>
                  <option value="4" ><?php echo $text_myprice4; ?></option>
                  <?php } ?>
                </select>
			 </td>
			 
			  <td width="200" style=" background: #E5E2D9;"><br/><br/>		  	  
			  <?php echo $entry_cheap; ?><br/><br/>
			  <?php echo $entry_refer; ?><br/><br />
			  <?php echo $text_kmenu; ?><br/><br/>
			  <?php echo $entry_zero; ?>
			  </td>
			  <td style=" background: #E5E2D9;">
				<?php echo '<b>' . $text_competitors . '</b>'; ?><br/><br/>
				 <select name="cheap">
				 <?php if(isset($cheap) and $cheap == 0) { ?>		
                  <option value="0" selected="selected"> <?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $text_no; ?></option>
                  <?php } ?>
			      <?php if(isset($cheap) and $cheap == 1) { ?>		
                  <option value="1" selected="selected"> <?php echo $text_math1; ?></option>
                  <?php } else { ?>
                  <option value="1"> <?php echo $text_math1; ?></option>
                  <?php } ?>
                  <?php if(isset($cheap) and $cheap == 2) { ?>		
                  <option value="2" selected="selected"><?php echo $text_math2; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $text_math2; ?></option>
                  <?php } ?>
				  <?php if(isset($cheap) and $cheap == 3) { ?>		
                  <option value="3" selected="selected"><?php echo $text_math3; ?></option>
                  <?php } else { ?>
                  <option value="3"><?php echo $text_math3; ?></option>
                  <?php } ?>
				  <?php if(isset($cheap) and $cheap == 4) { ?>		
                  <option value="4" selected="selected"><?php echo $text_math4; ?></option>
                  <?php } else { ?>
                  <option value="4"><?php echo $text_math4; ?></option>
                  <?php } ?>				  
				  <?php if(isset($cheap) and $cheap == 5) { ?>		
                  <option value="5" selected="selected"> <?php echo $text_math5; ?></option>
                  <?php } else { ?>
                  <option value="5"> <?php echo $text_math5; ?></option>
                  <?php } ?>
                  <?php if(isset($cheap) and $cheap == 6) { ?>		
                  <option value="6" selected="selected"><?php echo $text_math6; ?></option>
                  <?php } else { ?>
                  <option value="6"><?php echo $text_math6; ?></option>
                  <?php } ?>
				  <?php if(isset($cheap) and $cheap == 7) { ?>		
                  <option value="7" selected="selected"><?php echo $text_math7; ?></option>
                  <?php } else { ?>
                  <option value="7"><?php echo $text_math7; ?></option>
                  <?php } ?>
				  <?php if(isset($cheap) and $cheap == 8) { ?>		
                  <option value="8" selected="selected"><?php echo $text_math8; ?></option>
                  <?php } else { ?>
                  <option value="8"><?php echo $text_math8; ?></option>
                  <?php } ?>
                </select>
				   &nbsp;&nbsp;<?php echo $entry_onn;?>&nbsp;&nbsp;
				   <input type="text" name="onn" value="<?php if (isset($supplers['onn'])) echo $supplers['onn']; ?>" maxlength="12" size="4"/>
				 <br /><br />
				 <select name="refer">
				 <?php if(isset($refer) and $refer == 0) { ?>		
                  <option value="0" selected="selected"> <?php echo $text_refer0; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $text_refer0; ?></option>
                  <?php } ?>
			      <?php if(isset($refer) and $refer == 1) { ?>		
                  <option value="1" selected="selected"> <?php echo $text_refer1; ?></option>
                  <?php } else { ?>
                  <option value="1" > <?php echo $text_refer1; ?></option>
                  <?php } ?>				 
                </select>				
				 &nbsp;&nbsp;<?php echo $entry_disc;?>&nbsp;&nbsp;
				 <input type="text" name="disc" value="<?php if (isset($supplers['disc'])) echo $supplers['disc']; ?>" maxlength="12" size="4"/><br /><br />
				 <select name="kmenu">
			      <?php if(isset($kmenu) and $kmenu == 0) { ?>			
                  <option value="0" selected="selected"> <?php echo $text_kmenu0; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $text_kmenu0; ?></option>
                  <?php } ?>
				  <?php if(isset($kmenu) and $kmenu == 1) { ?>			
                  <option value="1" selected="selected"> <?php echo $text_kmenu1; ?></option>
                  <?php } else { ?>
                  <option value="1"> <?php echo $text_kmenu1; ?></option>
                  <?php } ?>
                  <?php if(isset($kmenu) and $kmenu == 2) { ?>			
                  <option value="2" selected="selected"><?php echo $text_kmenu2; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $text_kmenu2; ?></option>
                  <?php } ?>
				  <?php if(isset($kmenu) and $kmenu == 3) { ?>			
                  <option value="3" selected="selected"><?php echo $text_kmenu3; ?></option>
                  <?php } else { ?>
                  <option value="3"><?php echo $text_kmenu3; ?></option>
                  <?php } ?>
				  <?php if(isset($kmenu) and $kmenu == 4) { ?>			
                  <option value="4" selected="selected"><?php echo $text_kmenu4; ?></option>
                  <?php } else { ?>
                  <option value="4"><?php echo $text_kmenu4; ?></option>
                  <?php } ?>
				  <?php if(isset($kmenu) and $kmenu == 5) { ?>			
                  <option value="5" selected="selected"><?php echo $text_kmenu5; ?></option>
                  <?php } else { ?>
                  <option value="5"><?php echo $text_kmenu5; ?></option>
                  <?php } ?>
                </select>
				<br /><br />
				 <select name="zero">
				  <?php if(isset($zero) and $zero == 0) { ?>		
                  <option value="0" selected="selected"> <?php echo $text_zero0; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $text_zero0; ?></option>
                  <?php } ?>
			      <?php if(isset($zero) and $zero == 1) { ?>		
                  <option value="1" selected="selected"> <?php echo $text_zero1; ?></option>
                  <?php } else { ?>
                  <option value="1"> <?php echo $text_zero1; ?></option>
                  <?php } ?>
                  <?php if(isset($zero) and $zero == 2) { ?>		
                  <option value="2" selected="selected"><?php echo $text_zero2; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $text_zero2; ?></option>
                  <?php } ?>
				 </select> 
			  </td>			  
			  						
            </tr>			
			<tr style=" background: #EEEEEE;">
			  <td><?php echo $entry_desc; ?><br/><br/>
			  <?php echo $entry_pars; ?></td>
              <td><input type="text" name="descrip" value="<?php if (isset($supplers['descrip'])) echo $supplers['descrip']; ?>" maxlength="128" size="32" title = "e.g. &lt;div&gt;,&lt;/div&gt;,&lt;/div&gt;" /><br /><br/><br/><input type="text" name="parsd" value="<?php echo $supplers['parsd']; ?>" maxlength="4" size="4"/></td>
			  <td width="200"><?php echo $entry_point1; ?><br /><br /><?php echo $entry_place; ?></td>
			  <td><input type="text" name="pointd" value="<?php echo $supplers['pointd']; ?>" maxlength="64" size="32" title = "e.g. &lt;div class=&quot;full-desc&quot;&gt;" /><br/><br/><br /><input type="text" name="placed" value="<?php if (isset($supplers['placed'])) echo $supplers['placed']; ?>" maxlength="4" size="4" title = "1 - by default"/></td>			  
			  <td width="200"><?php echo $entry_mydescrip; ?><br/><br/>
			  <?php echo $entry_updte; ?><br/><br/>
			  <?php echo $entry_ddesc; ?></td>
			  
			  <td><input type="text" name="my_descrip" value="<?php echo $supplers['my_descrip']; ?>" maxlength="512" size="52"  title = "e.g. Подробности смотрите в разделе Характеристики"/>
			  <br/><br/>
				<select name="updte">
			      <?php if(isset($updte) and $updte == 1) { ?>			
                  <option value="1" selected="selected"> <?php echo $text_updte1; ?></option>
                  <?php } else { ?>
                  <option value="1"> <?php echo $text_updte1; ?></option>
                  <?php } ?>
                  <?php if(isset($updte) and $updte == 2) { ?>			
                  <option value="2" selected="selected"><?php echo $text_myprice1; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $text_myprice1; ?></option>
                  <?php } ?>
				  <?php if(isset($updte) and $updte == 3) { ?>			
                  <option value="3" selected="selected"><?php echo $text_updte3; ?></option>
                  <?php } else { ?>
                  <option value="3"><?php echo $text_updte3; ?></option>
                  <?php } ?>
				  <?php if(isset($updte) and $updte == 4) { ?>			
                  <option value="4" selected="selected"><?php echo $text_updte4; ?></option>
                  <?php } else { ?>
                  <option value="4"><?php echo $text_updte4; ?></option>
                  <?php } ?>
                </select>
				<br/><br/>
				<select name="ddesc">
			      <?php if(isset($ddesc) and $ddesc == 0) { ?>			
                  <option value="0" selected="selected"> <?php echo $text_ddesc0; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $text_ddesc0; ?></option>
                  <?php } ?>
                  <?php if(isset($ddesc) and $ddesc == 1) { ?>			
                  <option value="1" selected="selected"><?php echo $text_ddesc1; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_ddesc1; ?></option>
                  <?php } ?>
				  <?php if(isset($ddesc) and $ddesc == 2) { ?>			
                  <option value="2" selected="selected"><?php echo $text_ddesc2; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $text_ddesc2; ?></option>
                  <?php } ?>				  
                </select></td>					
            </tr>			
			<tr>
			  <td><?php echo $entry_manuf; ?><br/><br/>
			  <?php echo $entry_pars; ?></td>
              <td><input type="text" name="manuf" value="<?php if (isset($supplers['manuf'])) echo $supplers['manuf']; ?>" maxlength="128" size="32" title = "e.g. + 'BREND: ,("/><br /><br/><br/><input type="text" name="parsm" value="<?php echo $supplers['parsm']; ?>" maxlength="4" size="4"/></td>
			  <td width="200"><?php echo $entry_point1; ?><br/><br/><br/><?php echo $entry_place; ?></td>
			  <td><input type="text" name="pointm" value="<?php echo $supplers['pointm']; ?>" maxlength="64" size="32" title = "e.g. &lt;script&gt; " /><br/><br/><br/><input type="text" name="placem" value="<?php if (isset($supplers['placem'])) echo $supplers['placem']; ?>" maxlength="4" size="4" title = "1 - by default" /></td>			  
			  <td width="200"><?php echo $entry_mymanuf; ?><br/><br/><?php echo $entry_pmanuf; ?>
			  <br/><br/><?php echo $entry_umanuf; ?></td>			  
			  <td><select name="my_manuf">
                  <option value="0" selected="selected"><?php echo $text_none; ?></option>
                  <?php foreach ($manufacturers as $manufacturer) { ?>
                  <?php if (isset($my_manuf) and $manufacturer['manufacturer_id'] == $my_manuf) { ?>
                  <option value="<?php echo $manufacturer['manufacturer_id']; ?>" selected="selected"><?php echo $manufacturer['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
				<br /><br />				
                <?php if (isset($supplers['pmanuf']) and $supplers['pmanuf']) { ?>
                <input type="radio" name="pmanuf" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="pmanuf" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="pmanuf" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="pmanuf" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?>
				<br /><br />				
                <?php if (isset($supplers['umanuf']) and $supplers['umanuf']) { ?>
                <input type="radio" name="umanuf" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="umanuf" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="umanuf" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="umanuf" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?></td>				
            </tr>
			
			<tr style=" background: #EEEEEE;">
			  <td><span class="required">* </span><?php echo $entry_pic_ext; ?><br/><br/>
			  <?php echo $entry_pars; ?></td>
              <td><input type="text" name="pic_ext" value="<?php if (isset($supplers['pic_ext'])) echo $supplers['pic_ext']; ?>" maxlength="128" size="32" title = "e.g. 12,13,18,14" /><br /><br/><br/><input type="text" name="parsk" value="<?php echo $supplers['parsk']; ?>" maxlength="4" size="4"/></td>
			  <td width="200"><?php echo $entry_mymark; ?><br /><br /><br /><?php echo $entry_warranty; ?></td>
			  <td><input type="text" name="my_mark" value="<?php if (isset($supplers['my_mark'])) echo $supplers['my_mark']; ?>" maxlength="512" size="32" title = "e.g. big-photo,alt=,alt=,alt=,alt" /><br  /><br /><br /><input type="text" name="warranty" value="<?php echo $supplers['warranty']; ?>" maxlength="512" size="32" title = "e.g. &lt;1,&gt;3,&gt;4,&gt;5,&gt;6"/></td>
				  
			  <td width="200"><?php echo $entry_myphoto; ?><br /><br /><?php echo $entry_newphoto; ?></td>
			  <td>
			  <input type="text" name="my_photo" value="<?php echo $supplers['my_photo']; ?>" maxlength="512" size="52" title = "e.g. http//:www.bla-bla-bla.com/pic-gallery/12345.jpg"/>	
				<br /><br />
                <select name="newphoto">
			      <?php if(isset($newphoto) and $newphoto == 1) { ?>			
                  <option value="1" selected="selected"> <?php echo $text_updte1; ?></option>
                  <?php } else { ?>
                  <option value="1"> <?php echo $text_updte1; ?></option>
                  <?php } ?>
                  <?php if(isset($newphoto) and $newphoto == 2) { ?>			
                  <option value="2" selected="selected"><?php echo $text_updte2; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $text_updte2; ?></option>
                  <?php } ?>
				  <?php if(isset($newphoto) and $newphoto == 3) { ?>			
                  <option value="3" selected="selected"><?php echo $text_updte3; ?></option>
                  <?php } else { ?>
                  <option value="3"><?php echo $text_updte3; ?></option>
                  <?php } ?>
				  <?php if(isset($newphoto) and $newphoto == 4) { ?>			
                  <option value="4" selected="selected"><?php echo $text_updtee4; ?></option>
                  <?php } else { ?>
                  <option value="4"><?php echo $text_updtee4; ?></option>
                  <?php } ?>
				  <?php if(isset($newphoto) and $newphoto == 5) { ?>			
                  <option value="5" selected="selected"><?php echo $text_updtee5; ?></option>
                  <?php } else { ?>
                  <option value="5"><?php echo $text_updtee5; ?></option>
                  <?php } ?>
				  <?php if(isset($newphoto) and $newphoto == 6) { ?>			
                  <option value="6" selected="selected"><?php echo $text_ad3; ?></option>
                  <?php } else { ?>
                  <option value="6"><?php echo $text_ad3; ?></option>
                  <?php } ?>
                </select></td>		
			</tr>			
			<tr>
              <td><?php echo $entry_kol_status; ?></td>
              <td><input type="text" name="termin" value="<?php echo $supplers['termin']; ?>" maxlength="9" size="12" /></td>
			  <td width="200"><?php echo $entry_status_formula; ?></td>
			  <td><input type="text" name="t_status" value="<?php echo $supplers['t_status']; ?>" maxlength="255" size="32" /></td>
			  <td width="200"><?php echo $entry_set_status; ?></td>
			  <td>
			  <select name="status">                  
                  <?php foreach ($statuses as $st) { ?>
                  <?php if(isset($status) and $st['stock_status_id'] == $status) { ?>			
                  <option value="<?php echo $st['stock_status_id']; ?>" selected="selected"><?php echo $st['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $st['stock_status_id']; ?>"><?php echo $st['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
            </tr>
			<tr style=" background: #EEEEEE;">
			  <td><?php echo $entry_fields; ?></td>
              <td>UPC:<input type="text" name="upc" value="<?php if (isset($supplers['upc'])) echo $supplers['upc']; ?>" size="2" />
                EAN:<input type="text" name="ean" value="<?php if (isset($supplers['ean'])) echo $supplers['ean']; ?>" size="2" />
                MPN:<input type="text" name="mpn" value="<?php if (isset($supplers['mpn'])) echo $supplers['mpn']; ?>" size="2" /></td>
				<td></td><td></td><td></td><td></td>
			</tr>
			<tr>
			  <td><?php echo $entry_ref; ?></td>
              <td><input type="text" name="ref" value="<?php if (isset($supplers['ref'])) echo $supplers['ref']; ?>" maxlength="9" size="12" /></td>	
			  <td width="200"><?php echo $entry_target; ?></td>
			  <td>
			    <select name="t_ref">
				  <?php if(isset($t_ref) and $t_ref == 0) { ?>			
                  <option value="0" selected="selected"> <?php echo $text_ddesc0; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $text_ddesc0; ?></option>
                  <?php } ?>
			      <?php if(isset($t_ref) and $t_ref == 1) { ?>			
                  <option value="1" selected="selected"> <?php echo $entry_target1; ?></option>
                  <?php } else { ?>
                  <option value="1"> <?php echo $entry_target1; ?></option>
                  <?php } ?>
                  <?php if(isset($t_ref) and $t_ref == 2) { ?>			
                  <option value="2" selected="selected"><?php echo $entry_target2; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $entry_target2; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref) and $t_ref == 3) { ?>			
                  <option value="3" selected="selected"><?php echo $entry_target3; ?></option>
                  <?php } else { ?>
                  <option value="3"><?php echo $entry_target3; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref) and $t_ref == 4) { ?>			
                  <option value="4" selected="selected"><?php echo $entry_target4; ?></option>
                  <?php } else { ?>
                  <option value="4"><?php echo $entry_target4; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref) and $t_ref == 5) { ?>			
                  <option value="5" selected="selected"><?php echo $entry_target5; ?></option>
                  <?php } else { ?>
                  <option value="5"><?php echo $entry_target5; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref) and $t_ref == 6) { ?>			
                  <option value="6" selected="selected"><?php echo $entry_target6; ?></option>
                  <?php } else { ?>
                  <option value="6"><?php echo $entry_target6; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref) and $t_ref == 7) { ?>			
                  <option value="7" selected="selected"><?php echo $entry_target7; ?></option>
                  <?php } else { ?>
                  <option value="7"><?php echo $entry_target7; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref) and $t_ref == 8) { ?>			
                  <option value="8" selected="selected"><?php echo $entry_target8; ?></option>
                  <?php } else { ?>
                  <option value="8"><?php echo $entry_target8; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref) and $t_ref == 9) { ?>			
                  <option value="9" selected="selected"><?php echo $entry_target9; ?></option>
                  <?php } else { ?>
                  <option value="9"><?php echo $entry_target9; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref) and $t_ref == 10) { ?>			
                  <option value="10" selected="selected"><?php echo $entry_target10; ?></option>
                  <?php } else { ?>
                  <option value="10"><?php echo $entry_target10; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref) and $t_ref == 11) { ?>			
                  <option value="11" selected="selected"><?php echo $entry_target11; ?></option>
                  <?php } else { ?>
                  <option value="11"><?php echo $entry_target11; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref) and $t_ref == 12) { ?>			
                  <option value="12" selected="selected"><?php echo $entry_target12; ?></option>
                  <?php } else { ?>
                  <option value="12"><?php echo $entry_target12; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref) and $t_ref == 13) { ?>			
                  <option value="13" selected="selected"><?php echo $entry_target13; ?></option>
                  <?php } else { ?>
                  <option value="13"><?php echo $entry_target13; ?></option>
                  <?php } ?>				  
				  <?php if(isset($t_ref) and $t_ref == 14) { ?>			
                  <option value="14" selected="selected"><?php echo $entry_target14; ?></option>
                  <?php } else { ?>
                  <option value="14"><?php echo $entry_target14; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref) and $t_ref == 15) { ?>			
                  <option value="15" selected="selected"><?php echo $entry_target15; ?></option>
                  <?php } else { ?>
                  <option value="15"><?php echo $entry_target15; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref) and $t_ref == 16) { ?>			
                  <option value="16" selected="selected"><?php echo $entry_target16; ?></option>
                  <?php } else { ?>
                  <option value="16"><?php echo $entry_target16; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref) and $t_ref == 17) { ?>			
                  <option value="17" selected="selected"><?php echo $entry_target17; ?></option>
                  <?php } else { ?>
                  <option value="17"><?php echo $entry_target17; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref) and $t_ref == 18) { ?>			
                  <option value="18" selected="selected"><?php echo $entry_target18; ?></option>
                  <?php } else { ?>
                  <option value="18"><?php echo $entry_target18; ?></option>
                  <?php } ?>
                </select></td>
				<td></td><td></td>
			</tr>
			<tr style=" background: #EEEEEE;">
			<td><?php echo $entry_ref; ?></td>
              <td><input type="text" name="ref1" value="<?php if (isset($supplers['ref1'])) echo $supplers['ref1']; ?>" maxlength="9" size="12" /></td>	
			  <td width="200"><?php echo $entry_target; ?></td>
			  <td>
			    <select name="t_ref1">
				  <?php if(isset($t_ref1) and $t_ref1 == 0) { ?>			
                  <option value="0" selected="selected"> <?php echo $text_ddesc0; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $text_ddesc0; ?></option>
                  <?php } ?>
			      <?php if(isset($t_ref1) and $t_ref1 == 1) { ?>			
                  <option value="1" selected="selected"> <?php echo $entry_target1; ?></option>
                  <?php } else { ?>
                  <option value="1"> <?php echo $entry_target1; ?></option>
                  <?php } ?>
                  <?php if(isset($t_ref1) and $t_ref1 == 2) { ?>			
                  <option value="2" selected="selected"><?php echo $entry_target2; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $entry_target2; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref1) and $t_ref1 == 3) { ?>			
                  <option value="3" selected="selected"><?php echo $entry_target3; ?></option>
                  <?php } else { ?>
                  <option value="3"><?php echo $entry_target3; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref1) and $t_ref1 == 4) { ?>			
                  <option value="4" selected="selected"><?php echo $entry_target4; ?></option>
                  <?php } else { ?>
                  <option value="4"><?php echo $entry_target4; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref1) and $t_ref1 == 5) { ?>			
                  <option value="5" selected="selected"><?php echo $entry_target5; ?></option>
                  <?php } else { ?>
                  <option value="5"><?php echo $entry_target5; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref1) and $t_ref1 == 6) { ?>			
                  <option value="6" selected="selected"><?php echo $entry_target6; ?></option>
                  <?php } else { ?>
                  <option value="6"><?php echo $entry_target6; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref1) and $t_ref1 == 7) { ?>			
                  <option value="7" selected="selected"><?php echo $entry_target7; ?></option>
                  <?php } else { ?>
                  <option value="7"><?php echo $entry_target7; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref1) and $t_ref1 == 8) { ?>			
                  <option value="8" selected="selected"><?php echo $entry_target8; ?></option>
                  <?php } else { ?>
                  <option value="8"><?php echo $entry_target8; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref1) and $t_ref1 == 9) { ?>			
                  <option value="9" selected="selected"><?php echo $entry_target9; ?></option>
                  <?php } else { ?>
                  <option value="9"><?php echo $entry_target9; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref1) and $t_ref1 == 10) { ?>			
                  <option value="10" selected="selected"><?php echo $entry_target10; ?></option>
                  <?php } else { ?>
                  <option value="10"><?php echo $entry_target10; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref1) and $t_ref1 == 11) { ?>			
                  <option value="11" selected="selected"><?php echo $entry_target11; ?></option>
                  <?php } else { ?>
                  <option value="11"><?php echo $entry_target11; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref1) and $t_ref1 == 12) { ?>			
                  <option value="12" selected="selected"><?php echo $entry_target12; ?></option>
                  <?php } else { ?>
                  <option value="12"><?php echo $entry_target12; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref1) and $t_ref1 == 13) { ?>			
                  <option value="13" selected="selected"><?php echo $entry_target13; ?></option>
                  <?php } else { ?>
                  <option value="13"><?php echo $entry_target13; ?></option>
                  <?php } ?>				  
				  <?php if(isset($t_ref1) and $t_ref1 == 14) { ?>			
                  <option value="14" selected="selected"><?php echo $entry_target14; ?></option>
                  <?php } else { ?>
                  <option value="14"><?php echo $entry_target14; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref1) and $t_ref1 == 15) { ?>			
                  <option value="15" selected="selected"><?php echo $entry_target15; ?></option>
                  <?php } else { ?>
                  <option value="15"><?php echo $entry_target15; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref1) and $t_ref1 == 16) { ?>			
                  <option value="16" selected="selected"><?php echo $entry_target16; ?></option>
                  <?php } else { ?>
                  <option value="16"><?php echo $entry_target16; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref1) and $t_ref1 == 17) { ?>			
                  <option value="17" selected="selected"><?php echo $entry_target17; ?></option>
                  <?php } else { ?>
                  <option value="17"><?php echo $entry_target17; ?></option>
                  <?php } ?>
				  <?php if(isset($t_ref1) and $t_ref1 == 18) { ?>			
                  <option value="18" selected="selected"><?php echo $entry_target18; ?></option>
                  <?php } else { ?>
                  <option value="18"><?php echo $entry_target18; ?></option>
                  <?php } ?>
                </select></td>
				<td></td><td></td>
			</tr> 
			<tr>
			  <td><?php echo $entry_bonus; ?></td>
              <td><input type="text" name="bonus" value="<?php if (isset($supplers['bonus'])) echo $supplers['bonus']; ?>" maxlength="128" size="32" /></td>	
			  <td width="200" style=" background: #E5E2D9;" /><br /><br /> <?php echo $entry_addseo; ?></td>
              <td style=" background: #E5E2D9;" /><br /><br />			   
                <select name="addseo">
			      <?php if(isset($addseo) and $addseo == 0) { ?>			
                  <option value="0" selected="selected"> <?php echo $entry_addseo0; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $entry_addseo0; ?></option>
                  <?php } ?>
                  <?php if(isset($addseo) and $addseo == 1) { ?>			
                  <option value="1" selected="selected"><?php echo $entry_addseo1; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $entry_addseo1; ?></option>
                  <?php } ?>
				  <?php if(isset($addseo) and $addseo == 2) { ?>			
                  <option value="2" selected="selected"><?php echo $entry_addseo2; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $entry_addseo2; ?></option>
                  <?php } ?>				  
                </select></td>
			  <td width="200" style=" background: #E5E2D9;" /><?php echo '<b>'.$text_gbotton.'</b>'; ?><br /><br />
			  <?php echo $entry_off; ?></td>
                 <td style=" background: #E5E2D9;" /><br /><br /><?php if (isset($supplers['off']) and $supplers['off']) { ?>				 
                <input type="radio" name="off" value="1" checked="checked" />				
                <?php echo $text_yes; ?>
                <input type="radio" name="off" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="off" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="off" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?></td>
			</tr> 
			<tr>
              <td><?php echo $entry_dimension; ?></td>
              <td>M:<input type="text" name="weight" value="<?php echo $supplers['weight']; ?>" size="2" />
				L:<input type="text" name="length" value="<?php echo $supplers['length']; ?>" size="2" />
                W:<input type="text" name="width" value="<?php echo $supplers['width']; ?>" size="2" />
                H:<input type="text" name="height" value="<?php echo $supplers['height']; ?>" size="2" />
				</td>			  		
			  
			  <td width="200" style=" background: #E5E2D9;" /><?php echo $entry_upattr; ?></td>
              <td style=" background: #E5E2D9;" />
                <select name="upattr">
			      <?php if(isset($upattr) and $upattr == 0) { ?>			
                  <option value="0" selected="selected"> <?php echo $entry_upattr0; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $entry_upattr0; ?></option>
                  <?php } ?>
                  <?php if(isset($upattr) and $upattr == 1) { ?>			
                  <option value="1" selected="selected"><?php echo $entry_upattr1; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $entry_upattr1; ?></option>
                  <?php } ?>
				  <?php if(isset($upattr) and $upattr == 2) { ?>			
                  <option value="2" selected="selected"><?php echo $entry_upattr2; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $entry_upattr2; ?></option>
                  <?php } ?>
				  <?php if(isset($upattr) and $upattr == 3) { ?>			
                  <option value="3" selected="selected"> <?php echo $entry_upattr3; ?></option>
                  <?php } else { ?>
                  <option value="3"> <?php echo $entry_upattr3; ?></option>
                  <?php } ?>
				  <?php if(isset($upattr) and $upattr == 4) { ?>			
                  <option value="4" selected="selected"> <?php echo $entry_upattr4; ?></option>
                  <?php } else { ?>
                  <option value="4"> <?php echo $entry_upattr4; ?></option>
                  <?php } ?>
                </select></td>
			<td width="200" style=" background: #E5E2D9;" /><?php echo $entry_chcode; ?></td>
              <td style=" background: #E5E2D9;" /><?php if ($supplers['chcode']) { ?>
                <input type="radio" name="chcode" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="chcode" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="chcode" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="chcode" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?></td>
            </tr>			
			<tr>
			   <td style=" background: #D8D4C8;" ></span> <?php echo $entry_newproduct; ?></td>
			  <td style=" background: #D8D4C8;" ><input type="text" name="newproduct" value="<?php echo $supplers['newproduct']; ?>" maxlength="9" size="12" /></td>

			  <td width="200" style=" background: #D8D4C8;" /><?php echo $entry_upopt; ?><br /><br /><?php echo $entry_jopt; ?></td>
              <td style=" background: #D8D4C8;" />
			  <select name="upopt">
			      <?php if(isset($upopt) and $upopt == 0) { ?>			
                  <option value="0" selected="selected"> <?php echo $entry_upopt0; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $entry_upopt0; ?></option>
                  <?php } ?>
                  <?php if(isset($upopt) and $upopt == 1) { ?>			
                  <option value="1" selected="selected"><?php echo $entry_upopt1; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $entry_upopt1; ?></option>
                  <?php } ?>
				  <?php if(isset($upopt) and $upopt == 2) { ?>			
                  <option value="2" selected="selected"><?php echo $entry_upopt2; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $entry_upopt2; ?></option>
                  <?php } ?>				  
                </select>
				<br /><br />
				<?php if ($supplers['jopt']) { ?>
                <input type="radio" name="jopt" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="jopt" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="jopt" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="jopt" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?></td>
			  <td width="200" style=" background: #D8D4C8;" /><?php echo $entry_addopt; ?><br /><br /><?php echo $entry_skuopt; ?></td>
              <td style=" background: #D8D4C8;" /><?php if ($supplers['addopt']) { ?>
                <input type="radio" name="addopt" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="addopt" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="addopt" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="addopt" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?>
				<br /><br />
				<?php if ($supplers['optsku']) { ?>
                <input type="radio" name="optsku" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="optsku" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="optsku" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="optsku" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?></td>	
            </tr>
			
			<tr>
			  <td><?php echo $entry_myplus; ?></td>
              <td><input type="text" name="myplus" value="<?php echo $supplers['myplus']; ?>" maxlength="9" size="12" /></td>
			  <td width="200" style=" background: #D8D4C8;" /><?php echo $entry_opt_fotos; ?><br /><br /><?php echo $entry_plusopt; ?>
              <td style=" background: #D8D4C8;" /><?php if ($supplers['opt_fotos']) { ?>
                <input type="radio" name="opt_fotos" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="opt_fotos" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="opt_fotos" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="opt_fotos" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?>
				<br /><br />
				<?php if ($supplers['plusopt']) { ?>
                <input type="radio" name="plusopt" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="plusopt" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="plusopt" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="plusopt" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?></td>	
			  <td width="200" style=" background: #D8D4C8;" /><?php echo $entry_opt_prices; ?></td>
			  <td style=" background: #D8D4C8;" />              
			    <select name="opt_prices">
				<?php if($supplers['opt_prices'] == 0) { ?>
                  <option value="0" selected="selected"> <?php echo $opt_prices_s; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $opt_prices_s; ?></option>
                  <?php } ?>
                  <?php if($supplers['opt_prices'] == 1) { ?>			
                  <option value="1" selected="selected"><?php echo $opt_prices_min; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $opt_prices_min; ?></option>
                  <?php } ?>
				  <?php if($supplers['opt_prices'] == 2) { ?>			
                  <option value="2" selected="selected"><?php echo $opt_prices_plus; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $opt_prices_plus; ?></option>
                  <?php } ?>				  
                </select>			   
              </td>	
            </tr>
			
			<tr>
			  <td><?php echo $entry_order; ?></td>
              <td><input type="text" name="sorder" value="<?php if (isset($supplers['sorder'])) echo $supplers['sorder']; ?>" maxlength="9" size="12" /></td>
			  
			  <td width="200" style=" background: #E5E2D9;" /><?php echo $entry_upurl; ?></td>
               <td style=" background: #E5E2D9;" />
                <select name="upurl">
			      <?php if(isset($upurl) and $upurl == 0) { ?>			
                  <option value="0" selected="selected"> <?php echo $entry_upurl0; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $entry_upurl0; ?></option>
                  <?php } ?>
                  <?php if(isset($upurl) and $upurl == 1) { ?>			
                  <option value="1" selected="selected"><?php echo $entry_upurl1; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $entry_upurl1; ?></option>
                  <?php } ?>
				  <?php if(isset($upurl) and $upurl == 2) { ?>			
                  <option value="2" selected="selected"><?php echo $entry_upurl2; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $entry_upurl2; ?></option>
                  <?php } ?>				  
                </select></td>  
			  <td width="200" style=" background: #E5E2D9;" /><?php echo $entry_newurl; ?></td>
              <td style=" background: #E5E2D9;" />
			  <select name="newurl">
			      <?php if(isset($newurl) and $newurl == 0) { ?>			
                  <option value="0" selected="selected"> <?php echo $entry_newurl0; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $entry_newurl0; ?></option>
                  <?php } ?>
                  <?php if(isset($newurl) and $newurl == 1) { ?>			
                  <option value="1" selected="selected"><?php echo $entry_newurl1; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $entry_newurl1; ?></option>
                  <?php } ?>				  			  
                </select></td>
			</tr>			
			<tr>
			  <td><?php echo $entry_spec; ?></td>
              <td><input type="text" name="spec" value="<?php if (isset($supplers['spec'])) echo $supplers['spec']; ?>" maxlength="128" size="32" /></td>
				
			  <td width="200" style=" background: #E5E2D9;" /><?php echo $entry_cprice; ?></td>
              <td style=" background: #E5E2D9;" /><?php if (isset($supplers['cprice']) and $supplers['cprice']) { ?>
                <input type="radio" name="cprice" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="cprice" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="cprice" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="cprice" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?></td>
				<td width="200" style=" background: #E5E2D9;" /><?php echo $entry_importseo; ?></td>
                <td style=" background: #E5E2D9;" /><?php if (isset($supplers['importseo']) and $supplers['importseo']) { ?>
                <input type="radio" name="importseo" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="importseo" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="importseo" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="importseo" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?>				
				</td>
			</tr>							
			<tr>
			  <td><?php echo $entry_related; ?></td>
			  <td><input type="text" name="related" value="<?php echo $supplers['related']; ?>" maxlength="9" size="12" /></td>			  			
						
			  <td width="200" style=" background: #E5E2D9;"><?php echo $entry_hide; ?></td>
              <td style=" background: #E5E2D9;"><?php if ($supplers['hide']) { ?>
                <input type="radio" name="hide" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="hide" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="hide" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="hide" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?>								
				</td>	
			  <td width="200" style=" background: #E5E2D9;"><?php echo $entry_onoff; ?></td>
              <td style=" background: #E5E2D9;"><?php if ($supplers['onoff']) { ?>
                <input type="radio" name="onoff" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="onoff" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="onoff" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="onoff" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?></td>	
            </tr>
			<tr>
			<td><?php echo $entry_series; ?></td>
			<td><input type="text" name="serie" value="<?php echo $supplers['serie']; ?>" maxlength="9" size="12" /></td>
			<td style=" background: #E5E2D9;"><?php echo $entry_sleep; ?></td>
			<td style=" background: #E5E2D9;"><?php if ($supplers['sleep']) { ?>
				<input type="radio" name="sleep" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="sleep" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="sleep" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="sleep" value="0" checked="checked" />
                <?php echo $text_no; ?>
				<?php } ?></td>	
				<td style=" background: #E5E2D9;"><?php echo $entry_file; ?></td>
				<td style=" background: #E5E2D9;"><?php if ($supplers['ffile']) { ?>
				<input type="radio" name="ffile" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="ffile" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="ffile" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="ffile" value="0" checked="checked" />
                <?php echo $text_no; ?>
				<?php } ?></td>	
            </tr>
			<tr>
			<td><?php echo $entry_ad; ?></td>
              <td><select name="ad">
				 <?php if($supplers['ad'] == 1) { ?>		
                  <option value="1" selected="selected"> <?php echo $text_ad1; ?></option>
                  <?php } else { ?>
                  <option value="1"> <?php echo $text_ad1; ?></option>
                  <?php } ?>
			      <?php if($supplers['ad'] == 0) { ?>		
                  <option value="0" style="color: #0CC72A;" selected="selected"> <?php echo $text_ad0; ?></option>
                  <?php } else { ?>
                  <option value="0" style="color: #0CC72A;"> <?php echo $text_ad0; ?></option>
                  <?php } ?>
				  <?php if($supplers['ad'] == 3) { ?>		
                  <option value="3" style="color: #DE1A1A;" selected="selected"><?php echo $text_ad3; ?></option>
                  <?php } else { ?>
                  <option value="3" style="color: #DE1A1A;"><?php echo $text_ad3; ?></option>
                  <?php } ?>
				  <?php if($supplers['ad'] == 12) { ?>		
                  <option value="12" style="color: #0CC72A;" selected="selected"><?php echo $text_ad12; ?></option>
                  <?php } else { ?>
                  <option value="12" style="color: #0CC72A;"><?php echo $text_ad12; ?></option>
                  <?php } ?>
                  <?php if($supplers['ad'] == 2) { ?>		
                  <option value="2" selected="selected"><?php echo $text_ad2; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $text_ad2; ?></option>
                  <?php } ?>				  
				  <?php if($supplers['ad'] == 4) { ?>		
                  <option value="4" selected="selected"><?php echo $text_ad4; ?></option>
                  <?php } else { ?>
                  <option value="4"><?php echo $text_ad4; ?></option>
                  <?php } ?>
				  <?php if($supplers['ad'] == 10) { ?>		
                  <option value="10" selected="selected"><?php echo $text_ad10; ?></option>
                  <?php } else { ?>
                  <option value="10"><?php echo $text_ad10; ?></option>
                  <?php } ?>
				  <?php if($supplers['ad'] == 5) { ?>		
                  <option value="5" selected="selected"> <?php echo $text_ad5; ?></option>
                  <?php } else { ?>
                  <option value="5"> <?php echo $text_ad5; ?></option>
                  <?php } ?>
				  <?php if($supplers['ad'] == 6) { ?>		
                  <option value="6" selected="selected"><?php echo $text_ad6; ?></option>
                  <?php } else { ?>
                  <option value="6"><?php echo $text_ad6; ?></option>
                  <?php } ?>
                  <?php if($supplers['ad'] == 7) { ?>		
                  <option value="7" selected="selected"><?php echo $text_ad7; ?></option>
                  <?php } else { ?>
                  <option value="7"><?php echo $text_ad7; ?></option>
                  <?php } ?>				  
				  <?php if($supplers['ad'] == 8) { ?>		
                  <option value="8" selected="selected"><?php echo $text_ad8; ?></option>
                  <?php } else { ?>
                  <option value="8"><?php echo $text_ad8; ?></option>
                  <?php } ?>
				  <?php if($supplers['ad'] == 9) { ?>		
                  <option value="9" selected="selected"><?php echo $text_ad9; ?></option>
                  <?php } else { ?>
                  <option value="9"><?php echo $text_ad9; ?></option>
                  <?php } ?>
				  <?php if($supplers['ad'] == 11) { ?>		
                  <option value="11" style="color: #DE1A1A;" selected="selected"><?php echo $text_ad11; ?></option>
                  <?php } else { ?>
                  <option value="11" style="color: #DE1A1A;"><?php echo $text_ad11; ?></option>
                  <?php } ?>
                </select></td>
				<td style=" background: #E5E2D9;"><?php echo $entry_metka; ?></td>
				<td style=" background: #E5E2D9;">
				<?php if ($supplers['metka']) { ?>
                <input type="radio" name="metka" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="metka" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="metka" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="metka" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?>
				</td>
				<td style=" background: #E5E2D9;"><?php echo $entry_idcat; ?></td>
				<td style=" background: #E5E2D9;">
				<?php if ($supplers['idcat']) { ?>
                <input type="radio" name="idcat" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="idcat" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="idcat" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="idcat" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?>
				</td>
			</tr>
          </table>
		</div>		
		
        <div id="tab-data">
          <table class="form">          
			<tbody>
			<tr>			
			<td style="text-align: center; width: 1px;"></td>
			<td width = "200"><span class="required">*</span><?php echo $entry_cat_ext; ?></td>
              <td><input type="text" name="cat_ext[]" value="" maxlength="128" size="30" /></td>			  
			  <td><span class="required">*</span><?php echo $entry_cat_int; ?></td>
              <td><select name="category_id[]">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($categories as $category) { ?>
                  <?php if(isset($category_id) and $category['category_id'] == $category_id) { ?>			
                  <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
				
			  </tr> 
			  <tr>
			    <td style="text-align: center; width: 1px;"></td>
			    <td width = "200"><span class="required">*</span><?php echo $entry_pic_int; ?></td>
                <td><input type="text" name="pic_int[]" value="" maxlength="80" size="30" /></td>
				<td><?php echo $entry_cat_plus; ?></td>
                <td><input type="text" name="cat_plus[]" value="" maxlength="512" size="52" /></td>				
			  </tr>
			  
			  <tr style=" background: #EEEEEE;" />
			 <td style="text-align: center; width: 1px;"></td>
			<td width = "200"><span class="required">*</span><?php echo $entry_cat_ext; ?></td>
			<td><input type="text" name="cat_ext[]" value="" maxlength="128" size="30" /></td>	
			
			  <td><span class="required">*</span><?php echo $entry_cat_int; ?></td>
              <td><select name="category_id[]">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($categories as $category) { ?>
                  <?php if(isset($category_id) and $category['category_id'] == $category_id) { ?>			
                  <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
			  </tr>			  
			  <tr style=" background: #EEEEEE;" />
			    <td style="text-align: center; width: 1px;"></td>
			    <td width = "200"><span class="required">*</span><?php echo $entry_pic_int; ?></td>
                <td><input type="text" name="pic_int[]" value="" maxlength="80" size="30" /></td>
				
			    <td><?php echo $entry_cat_plus; ?></td>
                <td><input type="text" name="cat_plus[]" value="" maxlength="512" size="52" /></td>
			  </tr>
			
			  <tr>
			  <td style="text-align: center; width: 1px;"></td>
			<td width = "200"><span class="required">*</span><?php echo $entry_cat_ext; ?></td>
              <td><input type="text" name="cat_ext[]" value="" maxlength="128" size="30" /></td>
			  
			  <td><span class="required">*</span><?php echo $entry_cat_int; ?></td>
              <td><select name="category_id[]">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($categories as $category) { ?>
                  <?php if(isset($category_id) and $category['category_id'] == $category_id) { ?>			
                  <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
			  </tr> 
			  <tr>
			    <td style="text-align: center; width: 1px;"><strong><u>DEL</u></strong><input type="checkbox" onclick="$('input[name*=\'del\']').attr('checked', this.checked);" /></td>
			    <td width = "200"><span class="required">*</span><?php echo $entry_pic_int; ?></td>
                <td><input type="text" name="pic_int[]" value="" maxlength="80" size="30" /></td>
				
			    <td><?php echo $entry_cat_plus; ?></td>
                <td><input type="text" name="cat_plus[]" value="" maxlength="512" size="52" /></td>
			  </tr>
			
            <?php if (isset($suppler)) { $a = -3.14; $i = 0; $j = -1;?>
             <?php foreach ($suppler as $suppler) { $i=$i+1; $j = $j +1; if (pow ($a,$i) < 1) echo '<tr style=" background: #EEEEEE;" />';
			else echo '<tr>'; ?>
			<input type="hidden" name="nom_id[]" value="<?php echo $suppler['nom_id']; ?>" /></td>	
			  <td style="text-align: center; width: 1px;"><input type="checkbox" name="del[]" value="<?php echo $suppler['nom_id']; ?>" /></td>         
		      <td width = "200"><span class="required">*</span><?php echo $entry_cat_ext; ?></td>
              <td><input type="text" name="cat_ext[]" value="<?php echo $suppler['cat_ext']; ?>" maxlength="65" size="30" /></td>
		
			  <td><span class="required">*</span><?php echo $entry_cat_int; ?></td>
              <td><select name="category_id[]">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($categories as $category) { ?>
                  <?php if(isset($category_id[$j]) and $category['category_id'] == $category_id[$j]) { ?>	
                  <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
			</tr>
			
			<?php if (pow ($a,$i) < 1) echo '<tr style=" background: #EEEEEE;" />';
			else echo '<tr>'; ?>
			  <td style="text-align: center; width: 1px;"></td>
			  <td width = "200"><span class="required">*</span><?php echo $entry_pic_int; ?></td>
              <td><input type="text" name="pic_int[]" value="<?php echo $suppler['pic_int']; ?>" maxlength="80" size="30" /></td>
			  
			  <td><?php echo $entry_cat_plus; ?></td>
              <td><input type="text" name="cat_plus[]" value="<?php echo $suppler['cat_plus']; ?>" maxlength="512" size="52" />
			  </td>
			</tr>
			<?php } ?>
            <?php } else { ?>
            <tr>
              <?php $a = -5; $j = -1;
			  for ($i=1; $i<6; $i++) { $j = $j +1;
			  if (pow ($a,$i) < 0) 
			  echo '<tr style=" background: #EEEEEE;" />';
			  else echo '<tr>'; ?>
			  <td style="text-align: center; width: 1px;"><input type="checkbox" name="del[]" value="1" /></td>          
		      <td width = "200"><span class="required">*</span><?php echo $entry_cat_ext; ?></td>
              <td><input type="text" name="cat_ext[]" value="" maxlength="65" size="30" /></td>	
			  
			  <td><span class="required">*</span><?php echo $entry_cat_int; ?></td>
              <td><select name="category_id[]">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($categories as $category) { ?>
                  <?php if(isset($category_id[$j]) and $category['category_id'] == $category_id[$j]) { ?>	
                  <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
			  </tr> 
			  <?php if (pow ($a,$i) < 0) echo '<tr style=" background: #EEEEEE;" />';
			  else echo '<tr>'; ?>
			  <td style="text-align: center; width: 1px;"></td>
			  <td width = "200"><span class="required">*</span><?php echo $entry_pic_int; ?></td>
              <td><input type="text" name="pic_int[]" value="" maxlength="80" size="30" /></td>	
			  
			  <td><?php echo $entry_cat_plus; ?></td>
              <td><input type="text" name="cat_plus[]" value="" maxlength="512" size="52" /></td>
			  </tr>
			  <?php } ?>
              <?php } ?>
		    </tr>
           </tbody>
		  </table>          
        </div>
		
		<div id="tab-attribute">
          <table class="form">
            <tbody>
			<tr>
			  <td><?php echo $entry_attrib; ?></td>
              <td><input type="text" name="attr_ext[]" value="" maxlength="128" size="25" title = "e.g. &lt;div class=&quot;param&quot;&gt;,&lt;/div&gt;,&lt;td&gt;,&lt;/td&gt;" /></td>
			  <td width="150"><?php echo $entry_point1; ?></td>
			  <td><input type="text" name="attr_point[]" value="" maxlength="64" size="25" title = "e.g. &lt;div class=&quot;attribute-block" /></td>
			  <td width="150"><?php echo $entry_attribute; ?></td>
              <td><select name="attribute_id[]">
                  <option value="0"><?php echo $text_left; ?></option>
                  <?php foreach ($attributes as $attribute) { ?>
                  <?php if (isset($attribute_id) and $attribute['attribute_id'] == $attribute_id) { ?>			
                  <option value="<?php echo $attribute['attribute_id']; ?>" selected="selected"><?php echo  $attribute['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $attribute['attribute_id']; ?>"><?php echo $attribute['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
			</tr>	
			<tr>	
			  <td width="150"><?php echo $entry_filter; ?></td>
			  <td><select name="filter_group_id[]">
                  <option value="0"><?php echo $text_none; ?></option>
				  <?php if (isset($filters) and !empty($filters)) { ?>
                  <?php foreach ($filters as $filter) { ?>
                  <?php if(isset($filter_group_id) and $filter['filter_group_id'] == $filter_group_id) { ?>			
                  <option value="<?php echo $filter['filter_group_id']; ?>" selected="selected"><?php echo $filter['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $filter['filter_group_id']; ?>"><?php echo $filter['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
				  <?php } ?>
                </select></td>				
			    <td width="150"><?php echo $entry_tags; ?></td>
				 <td>
				 <select name="tags[]">			      		
                  <option value="0" selected="selected"> <?php echo $text_no; ?></option>
				  <option value="1"><?php echo $text_yes; ?></option>                  
				</select></td><td></td><td></td>
			</tr>
			<tr style=" background: #EEEEEE;" />
			  <td><?php echo $entry_attrib; ?></td>
              <td><input type="text" name="attr_ext[]" value="" maxlength="128" size="25" title = "e.g. &lt;div class=&quot;param&quot;&gt;,&lt;/div&gt;,&lt;td&gt;,&lt;/t" /></td>
			  <td width="150"><?php echo $entry_point1; ?></td>
			  <td><input type="text" name="attr_point[]" value="" maxlength="64" size="25" title = "e.g. &lt;div class=&quot;attribute-block" /></td>
			  <td width="150"><?php echo $entry_attribute; ?></td>
              <td><select name="attribute_id[]">
                  <option value="0"><?php echo $text_left; ?></option>
                  <?php foreach ($attributes as $attribute) { ?>
                  <?php if(isset($attribute_id) and $attribute['attribute_id'] == $attribute_id) { ?>			
                  <option value="<?php echo $attribute['attribute_id']; ?>" selected="selected"><?php echo  $attribute['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $attribute['attribute_id']; ?>"><?php echo $attribute['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
			</tr>	
			<tr style=" background: #EEEEEE;" />
			  <td width="150"><?php echo $entry_filter; ?></td>
			  <td><select name="filter_group_id[]">
                  <option value="0"><?php echo $text_none; ?></option>
				  <?php if (isset($filters) and !empty($filters)) { ?>
                  <?php foreach ($filters as $filter) { ?>
                  <?php if(isset($filter_group_id) and $filter['filter_group_id'] == $filter_group_id) { ?>			
                  <option value="<?php echo $filter['filter_group_id']; ?>" selected="selected"><?php echo $filter['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $filter['filter_group_id']; ?>"><?php echo $filter['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
				  <?php } ?>
                </select></td>
			    <td width="150"><?php echo $entry_tags; ?></td>
				 <td>
				 <select name="tags[]">			      		
                  <option value="0" selected="selected"> <?php echo $text_no; ?></option>
				  <option value="1"><?php echo $text_yes; ?></option>                  
				</select></td><td></td><td></td>
			</tr>
			<tr>
			  <td><?php echo $entry_attrib; ?></td>
              <td><input type="text" name="attr_ext[]" value="" maxlength="128" size="25" title = "e.g. 'attrib=,','" /></td>
			  <td width="150"><?php echo $entry_point1; ?></td>
			  <td><input type="text" name="attr_point[]" value="" maxlength="64" size="25" title = "e.g. &lt;div class=&quot;attribute-block" /></td>
			  <td width="150"><?php echo $entry_attribute; ?></td>
              <td><select name="attribute_id[]">
                  <option value="0"><?php echo $text_left; ?></option>
                  <?php foreach ($attributes as $attribute) { ?>
                  <?php if(isset($attribute_id) and $attribute['attribute_id'] == $attribute_id) { ?>			
                  <option value="<?php echo $attribute['attribute_id']; ?>" selected="selected"><?php echo  $attribute['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $attribute['attribute_id']; ?>"><?php echo $attribute['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
			</tr>	
			<tr>	
			  <td width="150"><?php echo $entry_filter; ?></td>
			  <td><select name="filter_group_id[]">
                  <option value="0"><?php echo $text_none; ?></option>
				  <?php if (isset($filters) and !empty($filters)) { ?>
                  <?php foreach ($filters as $filter) { ?>
                  <?php if(isset($filter_group_id) and $filter['filter_group_id'] == $filter_group_id) { ?>			
                  <option value="<?php echo $filter['filter_group_id']; ?>" selected="selected"><?php echo $filter['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $filter['filter_group_id']; ?>"><?php echo $filter['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
				  <?php } ?>
                </select></td>
			    <td width="150"><?php echo $entry_tags; ?></td>
				 <td>
				 <select name="tags[]">			      		
                  <option value="0" selected="selected"> <?php echo $text_no; ?></option>
				  <option value="1"><?php echo $text_yes; ?></option>                  
				</select></td><td></td><td></td>
			</tr>
			  
			 <?php if (isset($sa)) { $a = -3.14; $i = 0; $j = -1;?>
             <?php foreach ($sa as $sa) { $i=$i+1; $j = $j +1; if (pow ($a,$i) < 1) echo '<tr style=" background: #EEEEEE;" />';
			else echo '<tr>'; ?> 
			  <td><?php echo $entry_attrib; ?></td>
         	  <td><input type="text" name="attr_ext[]" value="<?php echo $sa['attr_ext']; ?>" maxlength="128" size="25"/></td>
			  <td width="150"><?php echo $entry_point1; ?></td>
			  <td><input type="text" name="attr_point[]" value="<?php echo $sa['attr_point']; ?>" maxlength="64" size="25" /></td>
			  <td width="150"><?php echo $entry_attribute; ?></td>			  
              <td><select name="attribute_id[]">
                  <option value="0"><?php echo $text_left; ?></option>
                  <?php foreach ($attributes as $attribute) { ?>
                  <?php if(isset($attribute_id[$j]) and $attribute['attribute_id'] == $attribute_id[$j]) { ?>			
                  <option value="<?php echo $attribute['attribute_id']; ?>" selected="selected"><?php echo  $attribute['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $attribute['attribute_id']; ?>"><?php echo $attribute['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
			</tr>	
			<?php if (pow ($a,$i) < 1) echo '<tr style=" background: #EEEEEE;" />';
			else echo '<tr>'; ?>	
			  <td width="150"><?php echo $entry_filter; ?></td>
			  <td><select name="filter_group_id[]">
                  <option value="0"><?php echo $text_none; ?></option>
				  <?php if (isset($filters) and !empty($filters)) { ?>
                  <?php foreach ($filters as $filter) { ?>
                  <?php if(isset($filter_group_id[$j]) and $filter['filter_group_id'] == $filter_group_id[$j]) { ?>			
                  <option value="<?php echo $filter['filter_group_id']; ?>" selected="selected"><?php echo $filter['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $filter['filter_group_id']; ?>"><?php echo $filter['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
				  <?php } ?>
                </select></td>
				 <td width="150"><?php echo $entry_tags; ?></td>
				 <td>
				 <select name="tags[]">
			      <?php if($sa['tags'] == 0) { ?>			
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
				  <option value="1" ><?php echo $text_yes; ?></option>
                  <?php } else { ?>
                  <option value="1" selected="selected"><?php echo $text_yes;  ?></option>
				  <option value="0" ><?php echo $text_no; ?></option>
                  <?php } ?>                  
				</select></td><td></td><td></td>		  
				<?php } ?>
              <?php } ?>		    
            </tr>
            </tbody>
		  </table>          
        </div>

		<div id="tab-option">
          <table class="form">
            <tbody>
			<tr>
			  <td ><?php echo $entry_option; ?></td>
              <td><select name="option_id[]">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($options as $opp) { ?>
                  <?php if(isset($option_id) and $opp['option_id'] == $option_id) { ?>			
                  <option value="<?php echo $opp['option_id']; ?>" selected="selected"><?php echo $opp['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $opp['option_id']; ?>"><?php echo $opp['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
				<td><span class="required">*</span><?php echo $entry_opt; ?></td>
				<td><input type="text" name="opt[]" value="" maxlength="64" size="20" /></td>
				<td><?php echo $entry_point1; ?></td>
				<td><input type="text" name="opt_point[]" value="" maxlength="64" size="20" /></td>
				<td><?php echo $entry_art; ?></td>
				<td><input type="text" name="art[]" value="" maxlength="4" size="4" /></td>
				<td><span class="required">*</span><?php echo $entry_ko; ?></td>
				<td><input type="text" name="ko[]" value="" maxlength="4" size="4" /></td>
				</tr>
				<tr>
				<td></span><?php echo $entry_pr; ?></td>
				<td><input type="text" name="pr[]" value="" maxlength="64" size="20" /></td>
				<td><?php echo $entry_po; ?></td>
				<td><input type="text" name="po[]" value="" maxlength="4" size="4" /></td>
				<td><?php echo $entry_we; ?></td>
				<td><input type="text" name="we[]" value="" maxlength="4" size="4" /></td>
				<td><?php echo $entry_foto; ?></td>
				<td><input type="text" name="foto[]" value="" maxlength="4" size="4" /></td>
				<td><?php echo $entry_option_required; ?></td>
				<td>
				 <select name="option_required[]">			      		
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
				  <option value="1"><?php echo $text_yes; ?></option>                  
				</select></td>
			</tr>
			  
			 <?php if (isset($op)) { $a = -3.14; $i = 0; $j = -1;?>
             <?php foreach ($op as $op) { $i=$i+1; $j = $j +1; if (pow ($a,$i) < 1) echo '<tr style=" background: #EEEEEE;" />';
			else echo '<tr>'; ?> 
			  <td ><?php echo $entry_option; ?></td>
              <td><select name="option_id[]">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($options as $opp) { ?>
                  <?php if(isset($option_id[$j]) and $opp['option_id'] == $option_id[$j]) { ?>			
                  <option value="<?php echo $opp['option_id']; ?>" selected="selected"><?php echo $opp['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $opp['option_id']; ?>"><?php echo $opp['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
				<td><span class="required">*</span><?php echo $entry_opt; ?></td>
				<td><input type="text" name="opt[]" value="<?php echo $op['opt']; ?>" maxlength="64" size="20" /></td>
				<td><?php echo $entry_point1; ?></td>
				<td><input type="text" name="opt_point[]" value="<?php echo $op['opt_point']; ?>" maxlength="64" size="20" /></td>
				<td><?php echo $entry_art; ?></td>				
				<td><input type="text" name="art[]" value="<?php echo $op['art']; ?>" maxlength="4" size="4" /></td>
				<td><span class="required">*</span><?php echo $entry_ko; ?></td>				
				<td><input type="text" name="ko[]" value="<?php echo $op['ko']; ?>" maxlength="4" size="4" /></td>
				</tr>
				<?php if (pow ($a,$i) < 1) echo '<tr style=" background: #EEEEEE;" />';
				else echo '<tr>'; ?> 
				<td></span><?php echo $entry_pr; ?></td>
				<td><input type="text" name="pr[]" value="<?php echo $op['pr']; ?>" maxlength="64" size="20" /></td>
				<td><?php echo $entry_po; ?></td>
				<td><input type="text" name="po[]" value="<?php echo $op['po']; ?>" maxlength="4" size="4" /></td>				
				<td><?php echo $entry_we; ?></td>
				<td><input type="text" name="we[]" value="<?php echo $op['we']; ?>" maxlength="4" size="4"/></td>
				<td><?php echo $entry_foto; ?></td>
				<td><input type="text" name="foto[]" value="<?php echo $op['foto']; ?>" maxlength="4" size="4" /></td>
				<td><?php echo $entry_option_required; ?></td>
				<td>
				 <select name="option_required[]">			      		
                  <?php if(isset($op['option_required']) and $op['option_required'] == 0) { ?>			
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
				  <option value="1" ><?php echo $text_yes; ?></option>
                  <?php } else { ?>
                  <option value="1" selected="selected"><?php echo $text_yes;  ?></option>
				  <option value="0" ><?php echo $text_no; ?></option>
                  <?php } ?>               
				</select></td>
				<?php } ?>
              <?php } ?>		    
            </tr>
            </tbody>
		  </table>          
        </div>		
	
	<div id="tab-price">
          <table class="form">
            <tr>
              <td><?php echo $entry_site_nom; ?></td>
				<td><input type="text" name="nom[]" maxlength="4" size="2" /></td>
				<td><?php echo $entry_site_ident; ?></td>
				<td><input type="text" name="ident[]" maxlength="16" size="16" /></td>				
				<td><?php echo $entry_site_param; ?></td>
				<td><input type="text" name="param[]" maxlength="128" size="18" /></td>
				<td><?php echo $entry_point1; ?></td>
				<td><input type="text" name="point[]" maxlength="64" size="18"/></td>				
            </tr>
			<tr>
              <td><?php echo $entry_noprice; ?></td>
				<td><input type="text" name="noprice[]" maxlength="64" size="18" /></td>							
				<td><?php echo $entry_site_param; ?></td>
				<td><input type="text" name="paramnp[]" maxlength="128" size="18" /></td>
				<td><?php echo $entry_point1; ?></td>
				<td><input type="text" name="pointnp[]" maxlength="64" size="18"/></td>
				<td><?php echo $entry_baseprice; ?></td>
				<td>
				 <select name="baseprice[]">			      
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
				  <option value="1" ><?php echo $text_yes; ?></option>                                  
				</select></td>
            </tr>
			<?php if (isset($site)) { $a = -3.14; $i = 0; $j = -1;?>
             <?php foreach ($site as $site) { $i=$i+1; $j = $j +1; if (pow ($a,$i) < 1) echo '<tr style=" background: #EEEEEE;" />';
			else echo '<tr>'; ?> 
			  <td><?php echo $entry_site_nom; ?></td>
				<td><input type="text" name="nom[]" value="<?php echo $site['nom']; ?>" maxlength="4" size="2" /></td>
				<td><?php echo $entry_site_ident; ?></td>
				<td><input type="text" name="ident[]" value="<?php echo $site['ident']; ?>" maxlength="16" size="16" /></td>				
				<td><?php echo $entry_site_param; ?></td>
				<td><input type="text" name="param[]" value="<?php echo $site['param']; ?>" maxlength="128" size="18" /></td>
				<td><?php echo $entry_point1; ?></td>
				<td><input type="text" name="point[]" value="<?php echo $site['point']; ?>" maxlength="64" size="18"/></td>
			<?php if (pow ($a,$i) < 1) echo '<tr style=" background: #EEEEEE;" />';
			else echo '<tr>'; ?>
				<td><?php echo $entry_noprice; ?></td>
				<td><input type="text" name="noprice[]" value="<?php echo $site['noprice']; ?>" maxlength="64" size="18" /></td>
				<td><?php echo $entry_site_param; ?></td>
				<td><input type="text" name="paramnp[]" value="<?php echo $site['paramnp']; ?>" maxlength="128" size="18" /></td>
				<td><?php echo $entry_point1; ?></td>
				<td><input type="text" name="pointnp[]" value="<?php echo $site['pointnp']; ?>" maxlength="64" size="18"/></td>
				<td><?php echo $entry_baseprice; ?></td>
				<td>
				 <select name="baseprice[]">
			      <?php if(isset($site['baseprice']) and $site['baseprice'] == 0) { ?>			
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
				  <option value="1" ><?php echo $text_yes; ?></option>
                  <?php } else { ?>
                  <option value="1" selected="selected"><?php echo $text_yes;  ?></option>
				  <option value="0" ><?php echo $text_no; ?></option>
                  <?php } ?>                  
				</select></td>
				<?php } ?>				
              <?php } ?>		    
            </tr>			
		  </table>          
        </div>

	<div id="tab-seo">
          <table class="form">
		    <tr><td></td><td style="text-indent: 360px;"><?php echo $entry_seo_prod; ?></td></tr>
			<tr style=" background: #EEEEEE;" />
              <td><?php echo $entry_seo_h1; ?></td>
			  <td><input type="text" name="prod_h1" value="<?php if (isset($seo['prod_h1'])) echo $seo['prod_h1']; ?>" maxlength="1000" size="150" /></td>			  
			</tr>
            <tr style=" background: #EEEEEE;" />
              <td><?php echo $entry_seo_title; ?></td>
			  <td><input type="text" name="prod_title" value="<?php if (isset($seo['prod_title'])) echo $seo['prod_title']; ?>" maxlength="1000" size="150" /></td>			  
			</tr>
	 		<tr style=" background: #EEEEEE;" />
              <td><?php echo $entry_seo_desc; ?></td>
			  <td><input type="text" name="prod_meta_desc" value="<?php if (isset($seo['prod_meta_desc'])) echo $seo['prod_meta_desc']; ?>" maxlength="1000" size="150" /></td>			  
			</tr>
			<tr style=" background: #EEEEEE;" />
              <td><?php echo $entry_seo_description; ?></td>
			  <td><textarea type="text" rows="4" cols="147" name="prod_desc" /><?php if (isset($seo['prod_desc'])) echo $seo['prod_desc']; ?></textarea></td>			  
			</tr>
			<tr style=" background: #EEEEEE;" />
              <td><?php echo $entry_seo_keyword; ?></td>
			  <td><input type="text" name="prod_keyword" value="<?php if (isset($seo['prod_keyword'])) echo $seo['prod_keyword']; ?>" maxlength="1000" size="150" /></td>				  
			</tr>			
			<tr><td><?php echo $entry_seo_nb; ?></td><td><strong>[n]</strong>- <?php echo $entry_seo_name; ?>&nbsp; <strong>[p]</strong>- <?php echo $entry_seo_price; ?>&nbsp; <strong>[sp]</strong>- <?php echo $entry_seo_sprice; ?>&nbsp; <strong>[c]</strong>- <?php echo $entry_seo_category; ?>&nbsp; <strong>[pc]</strong>- <?php echo $entry_seo_pcategory; ?>&nbsp;<strong>[m]</strong>- <?php echo $entry_seo_manufacturer; ?><br /><br /><strong>[d]</strong>- <?php echo $entry_descrip; ?>&nbsp; <strong>[<?php echo $entry_seo_attribut; ?>]</strong>- <?php echo $entry_seo_att; ?>&nbsp; <strong>[<?php echo $entry_seo_option; ?>]</strong>- <?php echo $entry_seo_opt; ?><br /><br /><strong>[{<?php echo $entry_seo_attribut; ?>}]</strong>- <?php echo $entry_seo_vatt; ?>&nbsp; <strong>[{<?php echo $entry_seo_option; ?>}]</strong>- <?php echo $entry_seo_vopt; ?>&nbsp; <strong>{i}</strong>- <?php echo $entry_seo_column; ?><br /><br /><strong>[b]</strong>- <?php echo $entry_seo_brand; ?>&nbsp; <strong>[sku]</strong>- <?php echo $entry_seo_sku; ?>&nbsp; <strong>[text|text|text|...]</strong>- <?php echo $entry_seo_text; ?>&nbsp; <strong>[i]</strong>- <?php echo $entry_seo_random; ?></td></tr>
			
			<tr><td></td><td style="text-indent: 360px;"><?php echo $entry_photo; ?></td></tr>
			<tr style=" background: #EEEEEE;" />
              <td><?php echo $entry_seo_photo; ?></td>
			  <td><input type="text" name="prod_photo" value="<?php if (isset($seo['prod_photo'])) echo $seo['prod_photo']; ?>" maxlength="1000" size="150" /></td>			  
			</tr>
			<tr><td><?php echo $entry_seo_nb; ?></td><td><strong>[n]</strong>- <?php echo $entry_seo_name; ?>&nbsp; <strong>[c]</strong>- <?php echo $entry_seo_category; ?>&nbsp;<strong>[m]</strong>- <?php echo $entry_seo_manufacturer; ?>&nbsp; <strong>[b]</strong>- <?php echo $entry_seo_brand; ?>&nbsp; <strong>[sku]</strong>- <?php echo $entry_seo_sku; ?>&nbsp; <strong>[mod]</strong>- <?php echo $entry_seo_code; ?><br /><br /><strong><span  class="required">*</span>[r]</strong>- <?php echo $entry_seo_number; ?></td></tr>
			
			<tr><td></td><td style="text-indent: 348px;"><?php echo $entry_seo_cat_cat; ?></td></tr>
			<tr style=" background: #EEEEEE;" /><td><?php echo $entry_seo_title; ?></td>
			  <td><input type="text" name="cat_title" value="<?php if (isset($seo['cat_title'])) echo $seo['cat_title']; ?>" maxlength="1000" size="150" /></td>
			</tr>  
			<tr style=" background: #EEEEEE;" /><td><?php echo $entry_seo_desc; ?></td>
			  <td><input type="text" name="cat_meta_desc" value="<?php if (isset($seo['cat_meta_desc'])) echo $seo['cat_meta_desc']; ?>" maxlength="1000" size="150" /></td>
			</tr>  
			<tr style=" background: #EEEEEE;" /><td><?php echo $entry_seo_description; ?></td>
			  <td><textarea type="text" rows="4" cols="147" name="cat_desc" /><?php if (isset($seo['cat_desc'])) echo $seo['cat_desc']; ?></textarea></td>
			</tr>
			<tr><td><?php echo $entry_seo_nb; ?></td><td><strong>[c]</strong>- <?php echo $entry_seo_category; ?>&nbsp; <strong>[pc]</strong>- <?php echo $entry_seo_pcategory; ?>&nbsp; <strong>[text|text|text|...]</strong>- <?php echo $entry_seo_text; ?></td></tr>
			
			<tr><td></td><td style="text-indent: 340px;"><?php echo $entry_seo_manuf; ?></td></tr>
			  <tr style=" background: #EEEEEE;" />
              <td><?php echo $entry_seo_title; ?></td>
			  <td><input type="text" name="manuf_title" value="<?php if (isset($seo['manuf_title'])) echo $seo['manuf_title']; ?>" maxlength="1000" size="150" /></td>			  
			</tr>
			<tr style=" background: #EEEEEE;" />
              <td><?php echo $entry_seo_desc; ?></td>
			  <td><input type="text" name="manuf_meta_desc" value="<?php if (isset($seo['manuf_meta_desc'])) echo $seo['manuf_meta_desc']; ?>" maxlength="1000" size="150" /></td>			  
			</tr>
			<tr style=" background: #EEEEEE;" />
              <td><?php echo $entry_seo_description; ?></td>
			  <td><textarea type="text" rows="4" cols="147" name="manuf_desc" /><?php if (isset($seo['manuf_desc'])) echo $seo['manuf_desc']; ?></textarea></td>			  
			</tr>
			<tr><td><?php echo $entry_seo_nb; ?></td><td><strong>[m]</strong>- <?php echo $entry_seo_manufacturer; ?>&nbsp; <strong>[text|text|text|...]</strong>- <?php echo $entry_seo_text; ?></td></tr>

			<tr><td></td><td style="text-indent: 335px;"><?php echo $entry_seo_round; ?></td></tr>
            <tr style=" background: #EEEEEE;" />
              <td align="right"><strong>[1]</strong></td>
			  <td><input type="text" name="seo_1" value="<?php if (isset($seo['seo_1'])) echo $seo['seo_1']; ?>" maxlength="1000" size="150" /></td>
			</tr>
			<tr style=" background: #EEEEEE;" />
			  <td align="right"><strong>[2]</strong></td>
			  <td><input type="text" name="seo_2" value="<?php if (isset($seo['seo_2'])) echo $seo['seo_2']; ?>" maxlength="1000" size="150" /></td>
			</tr>
			<tr style=" background: #EEEEEE;" />  
			  <td align="right"><strong>[3]</strong></td>
			  <td><input type="text" name="seo_3" value="<?php if (isset($seo['seo_3'])) echo $seo['seo_3']; ?>" maxlength="1000" size="150" /></td>
			</tr>
			<tr style=" background: #EEEEEE;" />  
			  <td align="right"><strong>[4]</strong></td>
			  <td><input type="text" name="seo_4" value="<?php if (isset($seo['seo_4'])) echo $seo['seo_4']; ?>" maxlength="1000" size="150" /></td>
			</tr>
			<tr style=" background: #EEEEEE;" />  
			  <td align="right"><strong>[5]</strong></td>
			  <td><input type="text" name="seo_5" value="<?php if (isset($seo['seo_5'])) echo $seo['seo_5']; ?>" maxlength="1000" size="150" /></td>
			</tr>
			<tr style=" background: #EEEEEE;" />  
			  <td align="right"><strong>[6]</strong></td>
			  <td><input type="text" name="seo_6" value="<?php if (isset($seo['seo_6'])) echo $seo['seo_6']; ?>" maxlength="1000" size="150" /></td>
			</tr>
			<tr style=" background: #EEEEEE;" />  
			  <td align="right"><strong>[7]</strong></td>
			  <td><input type="text" name="seo_7" value="<?php if (isset($seo['seo_7'])) echo $seo['seo_7']; ?>" maxlength="1000" size="150" /></td>
			</tr>
			<tr style=" background: #EEEEEE;" />  
			  <td align="right"><strong>[8]</strong></td>
			  <td><input type="text" name="seo_8" value="<?php if (isset($seo['seo_8'])) echo $seo['seo_8']; ?>" maxlength="1000" size="150" /></td>
			</tr>
			<tr style=" background: #EEEEEE;" />  
			  <td align="right"><strong>[9]</strong></td>
			  <td><input type="text" name="seo_9" value="<?php if (isset($seo['seo_9'])) echo $seo['seo_9']; ?>" maxlength="1000" size="150" /></td>
			</tr> 
			<tr style=" background: #EEEEEE;" />  
			  <td align="right"><strong>[10]</strong></td>
			  <td><input type="text" name="seo_10" value="<?php if (isset($seo['seo_10'])) echo $seo['seo_10']; ?>" maxlength="1000" size="150" /></td>			
			</tr>
			<tr style=" background: #EEEEEE;" />  
			  <td align="right"><strong>[11]</strong></td>
			  <td><input type="text" name="seo_11" value="<?php if (isset($seo['seo_11'])) echo $seo['seo_11']; ?>" maxlength="1000" size="150" /></td>			
			</tr>
			<tr style=" background: #EEEEEE;" />  
			  <td align="right"><strong>[12]</strong></td>
			  <td><input type="text" name="seo_12" value="<?php if (isset($seo['seo_12'])) echo $seo['seo_12']; ?>" maxlength="1000" size="150" /></td>			
			</tr>
			<tr style=" background: #EEEEEE;" />  
			  <td align="right"><strong>[13]</strong></td>
			  <td><input type="text" name="seo_13" value="<?php if (isset($seo['seo_13'])) echo $seo['seo_13']; ?>" maxlength="1000" size="150" /></td>			
			</tr>
			<tr style=" background: #EEEEEE;" />  
			  <td align="right"><strong>[14]</strong></td>
			  <td><input type="text" name="seo_14" value="<?php if (isset($seo['seo_14'])) echo $seo['seo_14']; ?>" maxlength="1000" size="150" /></td>			
			</tr>
			<tr style=" background: #EEEEEE;" />  
			  <td align="right"><strong>[15]</strong></td>
			  <td><input type="text" name="seo_15" value="<?php if (isset($seo['seo_15'])) echo $seo['seo_15']; ?>" maxlength="1000" size="150" /></td>			
			</tr>
			<tr style=" background: #EEEEEE;" />  
			  <td align="right"><strong>[16]</strong></td>
			  <td><input type="text" name="seo_16" value="<?php if (isset($seo['seo_16'])) echo $seo['seo_16']; ?>" maxlength="1000" size="150" /></td>			
			</tr>
			<tr style=" background: #EEEEEE;" />  
			  <td align="right"><strong>[17]</strong></td>
			  <td><input type="text" name="seo_17" value="<?php if (isset($seo['seo_17'])) echo $seo['seo_17']; ?>" maxlength="1000" size="150" /></td>			
			</tr>
			<tr style=" background: #EEEEEE;" />  
			  <td align="right"><strong>[18]</strong></td>
			  <td><input type="text" name="seo_18" value="<?php if (isset($seo['seo_18'])) echo $seo['seo_18']; ?>" maxlength="1000" size="150" /></td>			
			</tr>
			<tr style=" background: #EEEEEE;" />  
			  <td align="right"><strong>[19]</strong></td>
			  <td><input type="text" name="seo_19" value="<?php if (isset($seo['seo_19'])) echo $seo['seo_19']; ?>" maxlength="1000" size="150" /></td>			
			</tr>
			<tr style=" background: #EEEEEE;" />  
			  <td align="right"><strong>[20]</strong></td>
			  <td><input type="text" name="seo_20" value="<?php if (isset($seo['seo_20'])) echo $seo['seo_20']; ?>" maxlength="1000" size="150" /></td>			
			</tr>
			<tr><td><?php echo $entry_seo_nb; ?></td><td><strong>[n]</strong>- <?php echo $entry_seo_name; ?>&nbsp; <strong>[p]</strong>- <?php echo $entry_seo_price; ?>&nbsp; <strong>[sp]</strong>- <?php echo $entry_seo_sprice; ?>&nbsp; <strong>[c]</strong>- <?php echo $entry_seo_category; ?>&nbsp; <strong>[pc]</strong>- <?php echo $entry_seo_pcategory; ?>&nbsp;<strong>[m]</strong>- <?php echo $entry_seo_manufacturer; ?><br /><br /><strong>[d]</strong>- <?php echo $entry_descrip; ?>&nbsp; <strong>[<?php echo $entry_seo_attribut; ?>]</strong>- <?php echo $entry_seo_att; ?>&nbsp; <strong>[<?php echo $entry_seo_option; ?>]</strong>- <?php echo $entry_seo_opt; ?><br /><br /><strong>[{<?php echo $entry_seo_attribut; ?>}]</strong>- <?php echo $entry_seo_vatt; ?>&nbsp; <strong>[{<?php echo $entry_seo_option; ?>}]</strong>- <?php echo $entry_seo_vopt; ?>&nbsp; <strong>{i}</strong>- <?php echo $entry_seo_column; ?><br /><br /><strong>[b]</strong>- <?php echo $entry_seo_brand; ?>&nbsp; <strong>[sku]</strong>- <?php echo $entry_seo_sku; ?>&nbsp; <strong>[text|text|text|...]</strong>- <?php echo $entry_seo_text; ?>&nbsp; <strong>[i]</strong>- <?php echo $entry_seo_random; ?></td></tr>
			</tr>
		  </table>          
        </div>		
	</form>
	
	<form action="<?php echo $base; ?>" method="post" enctype="multipart/form-data" id="form1">
		<div id="tab-action">		
          <table class="form">
            <tbody>
			<tr><font color="#EE6363"><strong><?php echo $text_warring; ?></strong></font>
			</tr>
			<tr>
			  <td><font color="#003a88"><center><strong><h1><?php echo $text_settings; ?></h1></strong></center></font></td><td></td><td></td><td></td>
			</tr>
			<tr style=" background: #EEEEEE;" />
              <td><strong><?php echo $entry_actcat; ?></strong></td>
              <td><div class="scrollbox" style="background: #EEEEEE;">                  
                  <?php foreach ($categories as $category) { ?>                  
                    <div class="<?php if (isset($class)) echo $class; ?>">
                    <input type="checkbox" name="act_cat[]" value="<?php echo $category['category_id']; ?>" />
                    <?php echo $category['name']; ?>                   
                  </div>
                  <?php } ?>
                </div>
              </td>		
			  <td><strong><?php echo $entry_actmanuf; ?></strong><br /></td>
			  <td><select name="act_manuf">
                  <option value="0" selected="selected"><?php echo $text_all; ?></option>
                  <?php foreach ($manufacturers as $manufacturer) { ?>
                  <?php if (isset($act['act_manuf']) and $manufacturer['manufacturer_id'] == $act['act_manuf']) { ?>
                  <option value="<?php echo $manufacturer['manufacturer_id']; ?>" selected="selected"><?php echo $manufacturer['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
			</tr>
			<tr style=" background: #EEEEEE;" /> 
			  <td><strong><?php echo $entry_date_start; ?></strong><br /><br />
			  <input type="radio" name="up-add" value="0" checked="checked" />                
                <?php echo $entry_up; ?>                
                <input type="radio" name="up-add" value="1" />
                <?php echo $entry_add; ?></td>
              <td><input type="text" name="filter_date_start" value="0000-00-00" id="date-start" size="12" /> <?php echo $entry_any; ?></td>
              <td><strong><?php echo $entry_date_end; ?></strong></td>
              <td><input type="text" name="filter_date_end" value="0000-00-00" id="date-end" size="12" /> <?php echo $entry_any; ?></td>                      
			</tr>
			<tr style=" background: #EEEEEE;" />
			  <td><strong><?php echo $entry_cod_from; ?></strong><br /><br />
			  <input type="radio" name="cod-id" value="0" checked="checked" />                
                <?php echo $entry_codid1; ?>                
                <input type="radio" name="cod-id" value="1" />
                <?php echo $entry_codid2; ?></td>
              <td><input type="text" name="cod_from" maxlength="9" size="12" /> <?php echo $entry_any; ?></td>
			  <td><strong><?php echo $entry_cod_to; ?></strong></td>
              <td><input type="text" name="cod_to" maxlength="9" size="12" /> <?php echo $entry_any; ?></td>			  
			</tr>
			<tr style=" background: #EEEEEE;" />
			  <td><strong><?php echo $entry_price_from; ?></strong></td>
              <td><input type="text" name="price_from" maxlength="9" size="12" /> <?php echo $entry_any; ?></td>
			  <td><strong><?php echo $entry_price_to; ?></strong></td>
              <td><input type="text" name="price_to" maxlength="9" size="12" /> <?php echo $entry_any; ?></td>			  
			</tr>
			<tr style=" background: #EEEEEE;" />			  		  
			  <td><strong><?php echo $entry_all; ?></strong></td>               
              <td><input type="radio" name="all" value="0" checked="checked" />                
                <?php echo $text_only; ?>                
                <input type="radio" name="all" value="1" />
                <?php echo $text_wse; ?>
              </td>
			  <td><strong><?php echo $entry_kol; ?></strong></td> 
              <td><select name="isno">
			      <?php if(isset($isno) and $isno == 0) { ?>			
                  <option value="0" selected="selected"> <?php echo $text_dc; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $text_dc; ?></option>
                  <?php } ?>
                  <?php if(isset($isno) and $isno == 1) { ?>			
                  <option value="1" selected="selected"><?php echo $text_ended; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_ended; ?></option>
                  <?php } ?>
				  <?php if(isset($isno) and $isno == 2) { ?>			
                  <option value="2" selected="selected"><?php echo $text_status1; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $text_status1; ?></option>
                  <?php } ?>				  
                </select></td>
		  </tr>
		  <tr style=" background: #EEEEEE;" />            
			  <td><strong><?php echo $entry_sname; ?></strong></td>
              <td><input type="text" name="act_sname" maxlength="2048" size="42" /> <?php echo $entry_any; ?> </td>
			 <td><strong><?php echo $entry_sdesc; ?></strong></td>
              <td><input type="text" name="act_sdesc" maxlength="2048" size="42" /> <?php echo $entry_any; ?> </td>
		  </tr>
		  <tr style=" background: #EEEEEE;" />            
			  <td><strong><?php echo $entry_attribut; ?></strong></td>
              <td><input type="text" name="act_attribut" maxlength="2048" size="42" /> <?php echo $entry_any; ?> </td>
			 <td><strong><?php echo $entry_noattribut; ?></strong></td>
              <td><input type="text" name="act_noattribut" maxlength="2048" size="42" /> <?php echo $entry_any; ?> </td>
		  </tr>
		  <tr style=" background: #EEEEEE;" />            
			  <td><strong><?php echo $entry_inattribut; ?></strong></td>
              <td><input type="text" name="act_inattribut" maxlength="64" size="42" /> <?php echo $entry_any; ?> </td>
			 <td><strong><?php echo $entry_isvalue; ?></strong></td>
              <td><input type="text" name="act_isvalue" maxlength="2048" size="42" /></td>
		  </tr>
		  <tr style=" background: #EEEEEE;" />            
			  <td><strong><?php echo $entry_descr; ?></strong></td>
              <td><select name="descr">
			      <?php if(isset($descr) and $descr == 0) { ?>			
                  <option value="0" selected="selected"> <?php echo $entry_offproduct0; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $entry_offproduct0; ?></option>
                  <?php } ?>
                  <?php if(isset($descr) and $descr == 1) { ?>			
                  <option value="1" selected="selected"><?php echo $entry_offproduct1; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $entry_offproduct1; ?></option>
                  <?php } ?>
				  <?php if(isset($descr) and $descr == 2) { ?>			
                  <option value="2" selected="selected"><?php echo $entry_offproduct2; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $entry_offproduct2; ?></option>
                  <?php } ?>				  
                </select></td>
			  <td><strong><?php echo $entry_offproduct; ?></strong></td>
			  <td><select name="offproduct">
			      <?php if(isset($offproduct) and $offproduct == 0) { ?>			
                  <option value="0" selected="selected"> <?php echo $entry_offproduct0; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $entry_offproduct0; ?></option>
                  <?php } ?>
                  <?php if(isset($offproduct) and $offproduct == 1) { ?>			
                  <option value="1" selected="selected"><?php echo $entry_offproduct1; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $entry_offproduct1; ?></option>
                  <?php } ?>
				  <?php if(isset($offproduct) and $offproduct == 2) { ?>			
                  <option value="2" selected="selected"><?php echo $entry_offproduct2; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $entry_offproduct2; ?></option>
                  <?php } ?>				  
                </select></td>
		  </tr>
		  <tr style=" background: #EEEEEE;" />            
			  <td><strong><?php echo $entry_isattribute; ?></strong></td>
              <td><select name="isattribute">
			      <?php if(isset($isattribute) and $isattribute == 0) { ?>			
                  <option value="0" selected="selected"> <?php echo $entry_offproduct0; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $entry_offproduct0; ?></option>
                  <?php } ?>
                  <?php if(isset($isattribute) and $isattribute == 0) { ?>			
                  <option value="1" selected="selected"><?php echo $entry_offproduct1; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $entry_offproduct1; ?></option>
                  <?php } ?>
				  <?php if(isset($isattribute) and $isattribute == 0) { ?>			
                  <option value="2" selected="selected"><?php echo $entry_offproduct2; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $entry_offproduct2; ?></option>
                  <?php } ?>				  
                </select></td>
			  <td><strong><?php echo $entry_isoptions; ?></strong></td>
              <td><select name="isoptions">
			      <?php if(isset($isoptions) and $isoptions == 0) { ?>			
                  <option value="0" selected="selected"> <?php echo $entry_offproduct0; ?></option>
                  <?php } else { ?>
                  <option value="0"> <?php echo $entry_offproduct0; ?></option>
                  <?php } ?>
                  <?php if(isset($isoptions) and $isoptions == 0) { ?>			
                  <option value="1" selected="selected"><?php echo $entry_offproduct1; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $entry_offproduct1; ?></option>
                  <?php } ?>
				  <?php if(isset($isoptions) and $isoptions == 0) { ?>			
                  <option value="2" selected="selected"><?php echo $entry_offproduct2; ?></option>
                  <?php } else { ?>
                  <option value="2"><?php echo $entry_offproduct2; ?></option>
                  <?php } ?>				  
                </select></td>
		  </tr>
		  <tr>
			 <td><font color="#003a88"><center><strong><h1><?php echo $text_act; ?></h1></strong></center></font></td>		  
			 <td>
			  <select name="command" onchange="var command = this[this.selectedIndex]; if (command['onclick']) command.onclick();"> 
				  <option value="0"> <?php echo $text_command0; ?></option>
				  <option value="66" style="color: #0AAB1D;"> <?php echo $text_command66; ?></option>				  
				  <option value="22"><?php echo $text_command22; ?></option>
				  <option value="23"><?php echo $text_command23; ?></option>                  
                  <option value="2"><?php echo $text_command2; ?></option>				  
                  <option value="6"><?php echo $text_command6; ?></option>
				  <option value="46"><?php echo $text_command46; ?></option>
				  <option value="48"><?php echo $text_command48; ?></option>
				  <option value="40"><?php echo $text_command40; ?></option>
                  <option value="73"><?php echo $text_command73; ?></option>
				  <option value="74"><?php echo $text_command74; ?></option>
				  <option value="82"><?php echo $text_command82; ?></option>
				  <option value="123" style="color: #0AAB1D;"> <?php echo $text_command123; ?></option>	
                  <option value="7" style="color: #8F620D;"><?php echo $text_command7; ?></option> 
				  <option value="8" style="color: #8F620D;"><?php echo $text_command8; ?></option>
				  <option value="59" style="color: #8F620D;"><?php echo $text_command59; ?></option>
				  <option value="55" style="color: #8F620D;"><?php echo $text_command55; ?></option>
				  <option value="60" style="color: #8F620D;"><?php echo $text_command60; ?></option>
				  <option value="68" style="color: #DF620D;"><?php echo $text_command68; ?></option>
				  <option value="115"><?php echo $text_command115; ?></option>
				  <option value="1"> <?php echo $text_command1; ?></option>	
				  <option value="83"><?php echo $text_command83; ?></option>
				  <option value="101"><?php echo $text_command101; ?></option>
				  <option value="13"><?php echo $text_command13; ?></option>
				  <option value="103"><?php echo $text_command103; ?></option>				  
				  <option value="89" style="color: #8F620D;"><?php echo $text_command89; ?></option>
				  <option value="110" style="color: #8F620D;"><?php echo $text_command110; ?></option>
				  <option value="116" style="color: #8F620D;"><?php echo $text_command116; ?></option>
				  <option value="111" style="color: #8F620D;"><?php echo $text_command111; ?></option>
				  <option value="109" style="color: #8F620D;"><?php echo $text_command109; ?></option>
				  <option value="121" style="color: #8F620D;"><?php echo $text_command121; ?></option>
				  <option value="124" style="color: #8F620D;"><?php echo $text_command124; ?></option>
				  <option value="113" style="color: #8F620D;"><?php echo $text_command113; ?></option>
				  <option value="114" style="color: #8F620D;"><?php echo $text_command114; ?></option>
				  <option value="117"><?php echo $text_command117; ?></option>
				  <option value="118"><?php echo $text_command118; ?></option>
				  <option value="75" style="color: #0AAB1D;"><?php echo $text_command75; ?></option>
				  <option value="33" style="color: #0AAB1D;"><?php echo $text_command33; ?></option>
				  <option value="76" style="color: #0AAB1D;"><?php echo $text_command76; ?></option>
				  <option value="71" style="color: #0AAB1D;"><?php echo $text_command71; ?></option>
				  <option value="15" style="color: #0A10B5;"><?php echo $text_command15; ?></option>				  				  
				  <option value="28"><?php echo $text_command28; ?></option>
				  <option value="44"><?php echo $text_command44; ?></option>
				  <option value="93"><?php echo $text_command93; ?></option>
				  <option value="94"><?php echo $text_command94; ?></option>
				  <option value="95"><?php echo $text_command95; ?></option>
				  <option value="96"><?php echo $text_command96; ?></option>
				  <option value="97"><?php echo $text_command97; ?></option>
				  <option value="98"><?php echo $text_command98; ?></option>
				  <option value="99"><?php echo $text_command99; ?></option>
				  <option value="100"><?php echo $text_command100; ?></option>
				  <option value="106"><?php echo $text_command106; ?></option>
				  <option value="107"><?php echo $text_command107; ?></option>
				  <option value="108"><?php echo $text_command108; ?></option>
				  <option value="112"><?php echo $text_command112; ?></option>
				  <option value="41"><?php echo $text_command41; ?></option>
				  <option value="12" style="color: #0A10B5;" ><?php echo $text_command12; ?></option>
				  <option value="88" style="color: #0A10B5;" ><?php echo $text_command88; ?></option>
				  <option value="120" style="color: #0A10B5;" ><?php echo $text_command120; ?></option>				  
				  <option value="9" style="color: #0AAB1D;"><?php echo $text_command9;?></option>
				  <option value="10" style="color: #8F620D;"><?php echo $text_command10;?></option>				  
				  <option value="11" onclick='window.confirm("<?php echo $text_confirm; ?>");' style="color: #F42424;"><?php echo $text_command11;?></option>
				  <option value="125"><?php echo $text_command125; ?></option>
				  <option value="16"><?php echo $text_command16; ?></option>
				  <option value="27"><?php echo $text_command27; ?></option>
				  <option value="90"><?php echo $text_command90; ?></option>
				  <option value="42"><?php echo $text_command42; ?></option>
				  <option value="72"><?php echo $text_command72; ?></option>
				  <option value="19" ><?php echo $text_command19; ?></option>
				  <option value="62" onclick='window.confirm("<?php echo $text_confirm; ?>");' style="color: #F42424;"><?php echo $text_command62;?></option>
				  <option value="39"><?php echo $text_command39; ?></option>
				  <option value="81"><?php echo $text_command81; ?></option>
				  <option value="38"><?php echo $text_command38; ?></option>
				  <option value="77"><?php echo $text_command77; ?></option>
				  <option value="70"><?php echo $text_command70; ?></option>
				  <option value="92"><?php echo $text_command92; ?></option>
				  <option value="17"><?php echo $text_command17; ?></option>
				  <option value="54" style="color: #DF620D;" ><?php echo $text_command54; ?></option>
				  <option value="34"><?php echo $text_command34; ?></option>
				  <option value="91"><?php echo $text_command91; ?></option>				  
				  <option value="31" style="color: #8F620D;"><?php echo $text_command31; ?></option>
				  <option value="85" style="color: #8F620D;"><?php echo $text_command85; ?></option>
				  <option value="84" style="color: #8F620D;"><?php echo $text_command84; ?></option>
				  <option value="49" style="color: #DF620D;"><?php echo $text_command49; ?></option>
				  <option value="86" style="color: #DF620D;"><?php echo $text_command86; ?></option>
				  <option value="87" style="color: #DF620D;"><?php echo $text_command87; ?></option>
				  <option value="57" style="color: #8F620D;"><?php echo $text_command57; ?></option>
				  <option value="50"><?php echo $text_command50; ?></option>
				  <option value="32"><?php echo $text_command32; ?></option>
				  <option value="58"><?php echo $text_command58; ?></option>				  				  
				  <option value="18"><?php echo $text_command18; ?></option>
				  <option value="45" style="color: #0AAB1D;"><?php echo $text_command45; ?></option>
				  <option value="43" style="color: #0AAB1D;"><?php echo $text_command43; ?></option>
				  <option value="51" style="color: #0AAB1D;" ><?php echo $text_command51; ?></option>
				  <option value="52" style="color: #0AAB1D;" ><?php echo $text_command52; ?></option>
				  <option value="53" style="color: #0AAB1D;" ><?php echo $text_command53; ?></option>				  
				  <option value="20"><?php echo $text_command20; ?></option>
				  <option value="79"><?php echo $text_command79; ?></option>
				  <option value="21"><?php echo $text_command21; ?></option>
				  <option value="24"><?php echo $text_command24; ?></option>
				  <option value="35"><?php echo $text_command35; ?></option>
				  <option value="36"><?php echo $text_command36; ?></option>
				  <option value="37"><?php echo $text_command37; ?></option>
				  <option value="102"><?php echo $text_command102; ?></option>
				  <option value="80"><?php echo $text_command80; ?></option>
				  <option value="78"><?php echo $text_command78; ?></option>
				  <option value="61"><?php echo $text_command61; ?></option>
				  <option value="56"><?php echo $text_command56; ?></option>
				  <option value="119" style="color: #8F620D;"><?php echo $text_command119; ?></option>
				  <option value="105" style="color: #8F620D;"><?php echo $text_command105; ?></option>
				  <option value="104" style="color: #8F620D;"><?php echo $text_command104; ?></option>
				  <option value="122"><?php echo $text_command122; ?></option>
				  <option value="47"><?php echo $text_command47; ?></option>
				  <option value="14"><?php echo $text_command14; ?></option>
				  <option value="25" style="color: #0A10B5;"><?php echo $text_command25; ?></option>
				  <option value="26" style="color: #0A10B5;"><?php echo $text_command26; ?></option>				  
				  <option value="29" style="color: #8F620D;"><?php echo $text_command29; ?></option>
				  <option value="30" style="color: #8F620D;"><?php echo $text_command30; ?></option>
				  <option value="67" style="color: #8F620D;"><?php echo $text_command67; ?></option>
				  <option value="63" style="color: #8F620D;"><?php echo $text_command63; ?></option>
				  <option value="64" style="color: #8F620D;"><?php echo $text_command64; ?></option>
				  <option value="65" style="color: #8F620D;"><?php echo $text_command65; ?></option>
				  <option value="69" style="color: #8F620D;"><?php echo $text_command69; ?></option>
                </select></td>			  
			  <td><strong><?php echo $entry_find; ?></strong><br />
                <input type="text" name="act_find" maxlength="2048" size="32" /></td>			  
			  <td><strong><?php echo $entry_change; ?></strong>
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  <strong><?php echo $entry_actfilter; ?></strong><br />			    
                <input type="text" name="act_change" maxlength="2048" size="32" /> 			    
			    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			    <select name="act_filter_group_id">
                  <option value="0"><?php echo $text_all; ?></option>
				  <?php if (isset($filters) and !empty($filters)) { ?>
                  <?php foreach ($filters as $filter) { ?>
                  <?php if(isset($filter_group_id) and $filter['filter_group_id'] == $filter_group_id) { ?>			
                  <option value="<?php echo $filter['filter_group_id']; ?>" selected="selected"><?php echo $filter['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $filter['filter_group_id']; ?>"><?php echo $filter['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
				  <?php } ?>
                </select></td>
		  </tr>		    
		  <tr>
		  <td></td><td></td>
		   <td><strong> <?php echo $entry_zactcat; ?></strong></td>
			  <td><div class="scrollbox">                  
                  <?php foreach ($categories as $category) { ?>                  
                    <div class="<?php if (isset($class)) echo $class; ?>">
                    <input type="checkbox" name="zact_cat[]" value="<?php echo $category['category_id']; ?>" />
                    <?php echo $category['name']; ?>                   
                  </div>
                  <?php } ?>
                </div>
              </td>		      
		  </tr>  
            </tbody>  
          </table>
		</div>	
		<div class="buttons"><a onclick="$('#form1').submit();" class="button"><?php echo $button_base; ?></a>		
	  </form>
	   
	  <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>
 <script type="text/javascript"><!--
$(document).ready(function() {
	$('#date-start').datepicker({dateFormat: 'yy-mm-dd'});
	
	$('#date-end').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script>  
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs();
//--></script>
<?php echo $footer; ?>