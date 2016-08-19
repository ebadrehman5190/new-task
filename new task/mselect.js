  function myFunction(value) { 
        var options = document.getElementById('mSelect').options, count = 0;
        for (var i = 0; i < options.length; i++) {
            if (options[i].selected)
                count++;
        }
        var resultText = value/count ;
        console.log("resultText :"+resultText);
        document.getElementById("resultHere").value=resultText;
        
    }