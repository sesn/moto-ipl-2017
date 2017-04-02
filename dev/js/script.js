$(function(){
    $(document).on('click','#submit', function(){

        $token = $('#token').val();
        $applicantName = $('#applicantName').val();
        $gender = $('#gender').val();
        $dob = $('#dob').val();
        $shirtSize = $('#shirtSize').val();
        $childChance = $('#childChance').val();
        $puneDifferent = $('#puneDifferent').val();
        $parentName = $('#parentName').val();
        $parentMobile = $('#parentMobile').val();
        $parentEmail = $('#parentEmail').val();
        $parentAddress = $('#parentAddress').val();
        $homeMatch = $('#homeMatch').val();

        // console.log($token + $applicantName + $gender + $dob + $childChance + $puneDifferent + $parentName + $parentMobile + $parentEmail + $parentAddress + $homeMatch);
        $.ajax({
            url: 'post-form.php',
            method: 'POST',
            data: {
                'token' : $token, 
                'applicantName' : $applicantName,
                'gender' : $gender,
                'dob' : $dob,
                'shirtSize' : $shirtSize,
                'childChance' : $childChance,
                'puneDifferent' : $puneDifferent,
                'parentName' : $parentName,
                'parentMobile' : $parentMobile,
                'parentEmail' : $parentEmail,
                'parentAddress' : $parentAddress,
                'homeMatch' : $homeMatch,
                'conditionAccept' : '1'
            },
            success: function(data) {
                console.log(data);
                // $parsedData = JSON.parse(data);
                // console.log($parsedData);
            }, 
            error: function(data) {
                console.log(data);
            }
        });
        return false;
    });
});