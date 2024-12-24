
@extends('beranda')
@section('title-web', 'Faceapi')
@section('title-page', 'Face Detection') 

@section('content') 

<div class="card">
    <div class="card-body">  

        <div class="row"> 
            <div class="col-sm-8" style=""> 
                    <h3>Upload File</h3>
                    <hr> 
                    <input type="" id="_minConfidence" value="0.5"  placeholder="Score Max 0.xxx s/d 1"><br>
                    <input type="file" id="_file" class="form-control"><br>
                        
                    <div style="position: relative; "> 
                            <img id="img-view"  class="img-fluid rounded"  />  
                            <canvas id="overlay"></canvas> 
                    </div>  
            </div>
            <div class="col-sm-4">
                <h3>Result </h3>  
                <hr>
                <a class="load" style="display:none  " align="center" > Loading ... </a>
                <div class="jumlah-wajah"></div>

            </div>

        </div>

    </div>
</div>  


<script src="{{asset('faceapi')}}/face-api.js"></script>
<script>
    
    // ssd_mobilenetv1 options  
    let minConfidence
        

    // var _models = "{{asset('facemodels')}}/models/"
    var _models = "{{url('facemodels')}}/" 
    // var _models = "{{public_path('facemodels')}}/" 
    $(document).ready( function(){  
        $('#_file').change(function(){ 
             $('.load').show(); // Load Process 
            $('.jumlah-wajah').text('') 
            minConfidence = parseFloat ($('#_minConfidence').val())
            console.log('minConfidence', minConfidence)
            loadImageFromUpload()
        });
    })

 
    async function loadImageFromUpload() {  
        const imgFile = $('#_file').get(0).files[0]
        const img = await faceapi.bufferToImage(imgFile) 
        console.log('aceapi.bufferToImage', img)
        // $('#img-view').attr('width','300')
        $('#img-view').get(0).src = img.src
        updateResults()
    } 
    async function updateResults() {

        await faceapi.loadSsdMobilenetv1Model(_models); 
        console.log('Loading Models ..!!')
        
        const inputImgEl = $('#img-view').get(0)  
        console.log('3')
        
        const options = new faceapi.SsdMobilenetv1Options({ minConfidence })
        console.log('4. Option ', minConfidence)  

        const results = await faceapi.detectAllFaces(inputImgEl,  options ) // OK
        // const results = await faceapi.detectAllFaces(inputImgEl) OK Tanpa score
        console.log('5') 
        // console.log('results', results)
        let jum = results.length;
        $('.jumlah-wajah').text(jum + ' Wajah terdeteksi ')
        $(results).each(function(i){
            console.log(results[i]._score)
        })

        const canvas = $('#overlay').get(0) 
        faceapi.matchDimensions(canvas, inputImgEl)
        faceapi.draw.drawDetections(canvas, faceapi.resizeResults(results, inputImgEl))
        console.log('updateResults')
        
        $('.load').hide(); // Hide Process 
    }
    
</script>
 
<!-- <script src="{{asset('don')}}/js/upload-base64.js"></script> -->

@endsection  