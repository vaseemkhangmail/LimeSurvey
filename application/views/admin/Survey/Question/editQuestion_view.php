<?php PrepareEditorScript(true); ?>
<script type='text/javascript'><?php echo $qTypeOutput; ?></script>
<div class='header ui-widget-header'>
<?php if (!$adding) { ?>
    <?php echo $clang->gT("Edit question"); ?>
<?php } else { ?>
<?php echo $clang->gT("Add a new question"); ?>
<?php } ?>
</div>

           <div id='tabs'><ul>
           
        	
        	
        	<li><a href="#<?php echo $eqrow['language']; ?>"><?php echo getLanguageNameFromCode($eqrow['language'],false); ?>
            (<?php echo $clang->gT("Base language"); ?>)
        	</a></li>
            <?php if (!$adding) { 
        	$addlanguages=GetAdditionalLanguagesFromSurveyID($surveyid); 
                foreach  ($addlanguages as $addlanguage)
                { ?>
        		<li><a href="#<?php echo $addlanguage; ?>"><?php echo getLanguageNameFromCode($addlanguage,false); ?>
        	</a></li>
        		<?php }
        		} ?>
        		</ul>
        		<form name='frmeditquestion' id='frmeditquestion' action='<?php echo site_url("admin/database/index"); ?>' method='post' onsubmit="return isEmpty(document.getElementById('title'), '<?php echo $clang->gT("Error: You have to enter a question code.",'js'); ?>');">
        
            
            <div id="<?php echo $eqrow['language']; ?>">
            <?php $eqrow  = array_map('htmlspecialchars', $eqrow); ?>
            <div class='settingrow'><span class='settingcaption'><?php echo $clang->gT("Code:"); ?></span>
            <span class='settingentry'><input type='text' size='20' maxlength='20'  id='title' name='title' value="<?php echo $eqrow['title']; ?>" />
            </span></div>
            <div class='settingrow'><span class='settingcaption'><?php echo $clang->gT("Question:"); ?></span>
            <span class='settingentry'><textarea cols='50' rows='4' name='question_<?php echo $eqrow['language']; ?>'><?php echo $eqrow['question']; ?></textarea>
            <?php echo getEditor("question-text","question_".$eqrow['language'], "[".$clang->gT("Question:", "js")."](".$eqrow['language'].")",$surveyid,$gid,$qid,$action); ?>
            </span></div>
            <div class='settingrow'><span class='settingcaption'><?php echo $clang->gT("Help:"); ?></span>
            <span class='settingentry'><textarea cols='50' rows='4' name='help_<?php echo $eqrow['language']; ?>'><?php echo $eqrow['help']; ?></textarea>
            <?php echo getEditor("question-help","help_".$eqrow['language'], "[".$clang->gT("Help:", "js")."](".$eqrow['language'].")",$surveyid,$gid,$qid,$action); ?>
            </span></div>
            <div class='settingrow'><span class='settingcaption'>&nbsp;</span>
            <span class='settingentry'>&nbsp;
            </span></div>
            &nbsp;</div>
        
        
            <?php if (!$adding)
            { 
               
                foreach ($aqresult->result_array() as $aqrow)
                { ?>
                    
                    <div id="<?php echo $aqrow['language']; ?>">
                    <?php $aqrow  = array_map('htmlspecialchars', $aqrow); ?>
                    <div class='settingrow'><span class='settingcaption'><?php echo $clang->gT("Question:"); ?></span>
                    <span class='settingentry'><textarea cols='50' rows='4' name='question_<?php echo $aqrow['language']; ?>'><?php echo $aqrow['question']; ?></textarea>
                    <?php echo getEditor("question-text","question_".$aqrow['language'], "[".$clang->gT("Question:", "js")."](".$aqrow['language'].")",$surveyid,$gid,$qid,$action); ?>
                    </span></div>
                    <div class='settingrow'><span class='settingcaption'><?php echo $clang->gT("Help:"); ?></span>
                    <span class='settingentry'><textarea cols='50' rows='4' name='help_<?php echo $aqrow['language']; ?>'><?php echo $aqrow['help']; ?></textarea>
                    <?php echo getEditor("question-help","help_".$aqrow['language'], "[".$clang->gT("Help:", "js")."](".$aqrow['language'].")",$surveyid,$gid,$qid,$action); ?>
                    </span></div>
                    </div>
                <?php }
            }
            else
            {
                $addlanguages=GetAdditionalLanguagesFromSurveyID($surveyid);
                foreach  ($addlanguages as $addlanguage)
                { ?>
                    <div id="<?php echo $addlanguage; ?>">
                    </h2>
                    <div class='settingrow'><span class='settingcaption'><?php echo $clang->gT("Question:"); ?></span>
                    <span class='settingentry'><textarea cols='50' rows='4' name='question_<?php echo $addlanguage; ?>'></textarea>
                    <?php echo getEditor("question-text","question_".$addlanguage, "[".$clang->gT("Question:", "js")."](".$addlanguage.")",$surveyid,$gid,$qid,$action); ?>
                    </span></div>
                    <div class='settingrow'><span class='settingcaption'><?php echo $clang->gT("Help:"); ?></span>
                    <span class='settingentry'><textarea cols='50' rows='4' name='help_<?php echo $addlanguage; ?>'></textarea>
                    <?php echo getEditor("question-help","help_".$addlanguage, "[".$clang->gT("Help:", "js")."](".$addlanguage.")",$surveyid,$gid,$qid,$action); ?>
                    </span></div>
                    <div class='settingrow'><span class='settingcaption'>&nbsp;</span>
                    <span class='settingentry'>&nbsp;
                    </span></div>
                    </div>
                <?php }
            } ?>
        
        
            
            <div id='questionbottom'><ul>
            <li><label for='question_type'><?php echo $clang->gT("Question Type:"); ?></label>
            <?php if ($activated != "Y")
            { ?>
            	
                <select id='question_type' style='margin-bottom:5px' name='type' class='<?php echo $selectormodeclass; ?>'>
                <?php echo getqtypelist($eqrow['type'],'group'); ?>
                
                </select>
            <?php }
            else
            { 
                
                $qtypelist=getqtypelist('','array');
                echo "{$qtypelist[$eqrow['type']]['description']} - ".$clang->gT("Cannot be changed (survey is active)"); ?>
                <input type='hidden' name='type' id='question_type' value='<?php echo $eqrow['type']; ?>' />
            <?php } ?>
        
            </li>
        
            
        
            <?php if ($activated != "Y")
            { ?>
                <li>
                <label for='gid'><?php echo $clang->gT("Question group:"); ?></label>
                <select name='gid' id='gid'>
                
                <?php echo getgrouplist3($eqrow['gid'],$surveyid); ?>
                </select></li>
            <?php }
            else
            { ?>
                <li>
                <label><?php echo $clang->gT("Question group:"); ?></label>
                <?php echo getgroupname($eqrow['gid'])." - ".$clang->gT("Cannot be changed (survey is active)"); ?>
                <input type='hidden' name='gid' value='<?php echo $eqrow['gid']; ?>' />
                </li>
            <?php } ?>
            <li id='OtherSelection'>
            <label><?php echo $clang->gT("Option 'Other':"); ?></label>
        
            <?php if ($activated != "Y")
            { ?>
                <label for='OY'><?php echo $clang->gT("Yes"); ?></label><input id='OY' type='radio' class='radiobtn' name='other' value='Y'
                <?php if ($eqrow['other'] == "Y") { ?>
                checked
                <?php } ?>
                 />&nbsp;&nbsp;
                <label for='ON'><?php echo $clang->gT("No"); ?></label><input id='ON' type='radio' class='radiobtn' name='other' value='N'
                <?php if ($eqrow['other'] == "N" || $eqrow['other'] == "" ) { ?>
                 checked='checked'
                 <?php } ?>
                 />
            <?php }
            else
            { 
                 echo "[{$eqrow['other']}] - ".$clang->gT("Cannot be changed (survey is active)"); ?>
                 <input type='hidden' name='other' value="<?php echo $eqrow['other']; ?>" />
            <?php } ?>
            </li>
        
            <li id='MandatorySelection'>
            <label><?php echo $clang->gT("Mandatory:"); ?></label>
            <label for='MY'><?php echo $clang->gT("Yes"); ?></label><input id='MY' type='radio' class='radiobtn' name='mandatory' value='Y'
            <?php if ($eqrow['mandatory'] == "Y") { ?>
            checked='checked'
            <?php } ?>
             />&nbsp;&nbsp;
            <label for='MN'><?php echo $clang->gT("No"); ?></label><input id='MN' type='radio' class='radiobtn' name='mandatory' value='N'
            <?php if ($eqrow['mandatory'] != "Y") { ?>
            checked='checked'
            <?php } ?>
             />
            </li>
        
            <li id='Validation'>
            <label for='preg'><?php echo $clang->gT("Validation:"); ?></label>
            <input type='text' id='preg' name='preg' size='50' value="<?php echo $eqrow['preg']; ?>" />
            </li>
        
        
            <?php if ($adding)
            {
        
                if ($oqresult->num_rows())
                { ?>
                    
                    <li>
                    <label for='questionposition'><?php echo $clang->gT("Position:"); ?></label>
                    <select name='questionposition' id='questionposition'>
                    <option value=''><?php echo $clang->gT("At end"); ?></option>
                    <option value='0'><?php echo $clang->gT("At beginning"); ?></option>
                    <?php foreach ($oqresult->result_array() as $oq)
                    { ?>
                        <?php $question_order_plus_one = $oq['question_order']+1; ?>
                        <option value='<?php echo $question_order_plus_one; ?>'><?php echo $clang->gT("After"); ?>: <?php echo $oq['title']; ?></option>
                    <?php } ?> 
                    </select>
                    </li>
                <?php }
                else
                { ?>
                    <input type='hidden' name='questionposition' value='' />
                <?php }
            } ?>
        
            </ul>
            <p><a id="showadvancedattributes"><?php echo $clang->gT("Show advanced settings"); ?></a><a id="hideadvancedattributes" style="display:none;"><?php echo $clang->gT("Hide advanced settings"); ?></a></p>
            <div id="advancedquestionsettingswrapper" style="display:none;">
            <div class="loader"><?php echo $clang->gT("Loading..."); ?></div>
            <div id="advancedquestionsettings"></div>
            </div>
            <p><input type='submit' value='<?php echo $clang->gT("Save"); ?>' />
        
            <?php if ($adding)
            { ?>
                <input type='hidden' name='action' value='insertquestion' />
                <input type='hidden' name='gid' value='<?php echo $eqrow['gid']; ?>' />
            <?php }
            else
            { ?>
                <input type='hidden' name='action' value='updatequestion' />
                <input type='hidden' id='qid' name='qid' value='<?php echo $qid; ?>' />
            <?php } ?>
            <input type='hidden' id='sid' name='sid' value='<?php echo $surveyid; ?>' /></p>
            </div></form></div>
        
        
        
            <?php if ($adding)
            {
                
        
                if (bHasSurveyPermission($surveyid,'surveycontent','import'))
                { ?>
                    <br /><div class='header ui-widget-header'><?php echo $clang->gT("...or import a question"); ?></div>
                    <form enctype='multipart/form-data' id='importquestion' name='importquestion' action='$scriptname' method='post' onsubmit='return validatefilename(this,"<?php echo $clang->gT('Please select a file to import!','js'); ?>");'>
                    <ul>
                    <li>
                    <label for='the_file'><?php echo $clang->gT("Select LimeSurvey question file (*.lsq/*.csv)"); ?>:</label>
                    <input name='the_file' id='the_file' type="file" size="50" />
                    </li>
                    <li>
                    <label for='translinksfields'><?php echo $clang->gT("Convert resource links?"); ?></label>
                    <input name='translinksfields' id='translinksfields' type='checkbox' checked='checked'/>
                    </li>
                    </ul>
                    <p>
                    <input type='submit' value='<?php echo $clang->gT("Import Question"); ?>' />
                    <input type='hidden' name='action' value='importquestion' />
                    <input type='hidden' name='sid' value='<?php echo $surveyid; ?>' />
                    <input type='hidden' name='gid' value='<?php echo $gid; ?>' />
                    </form>
                    
                <?php } ?>
        
                <script type='text/javascript'>
                <!--
                document.getElementById('title').focus();
                //-->
                </script>
        
            <?php } ?>