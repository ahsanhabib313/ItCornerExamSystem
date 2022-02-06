//get the designation value
function isFresher(value){
    if(value == 1){// 1 means fresher
        $('.experience_div').css('display','none');
        $('.salary_div').css('display','none');
        $('select[name="experience"]').val(null);
        $('input[name="expected_salary"]').val(null)
    }
    if(value == 0){// 0 means not fresher
        $('.experience_div').css('display','block');
        $('.salary_div').css('display','block');
    }

}

