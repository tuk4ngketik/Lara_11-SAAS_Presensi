
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
                        <input type="file" id="_file" class="form-control"><br> 
                        
                        <div style="position: relative; "> 
                            <img id="img-view"  class="img-fluid rounded"  />  
                            <canvas id="overlay"></canvas> 
                        </div>  
                </div>

                <div class="col-sm-4">
                    <h3>Result </h3>  
                    <hr>
                    <h3 class="load" style="display:none  " align="center" > Loading ... </h3> 
                    <div class="alert alert-warning" id="message"></div>
                    <div id="facesContainer"  style="position: relative; "></div>

                    <hr>   
                    <p>Tensor / ( Single Face )</p>
                    <p> 
                        <label for="">Score</label>
                        <input id="score"  readonly/>
                    </p>
                    <p> 
                        <label for="">Tensor / Descriptor</label>
                        <textarea class="form-control" id="tensor" readonly></textarea>
                    </p>
                    <p>
                        <label for="">Image tool</label>
                        <img id="img-tool" />
                    </p>

                </div>

            </div>    
    
    </div>
</div>  


<script src="{{asset('faceapi')}}/face-api.js"></script>
<script>
    
    let data_score;
    let data_tensor;
    var _models = "{{url('facemodels')}}/"  
    
    $(document).ready( function(){  
        loadModels()
        $('#_file').change(function(){ 
            $('.load').show(); // Load Process 
            $('.jumlah-wajah').text('') 
            loadImageFromUpload()
        });
    })

    async function loadModels(){
        
        await faceapi.loadSsdMobilenetv1Model(_models); 
        // await faceapi.loadTinyFaceDetectorModel(_models)
        // await faceapi.loadMtcnnModel(_models)
        await faceapi.loadFaceLandmarkModel(_models)
        // await faceapi.loadFaceLandmarkTinyModel(_models)
        await faceapi.loadFaceRecognitionModel(_models)
        // await faceapi.loadFaceExpressionModel(_models)
        console.log('Load Models .... !')
    }

 
    async function loadImageFromUpload() {  
        $('#facesContainer').empty()
        $('#message').text('')
        const imgFile = $('#_file').get(0).files[0]
        const img = await faceapi.bufferToImage(imgFile) 
        console.log('aceapi.bufferToImage', img) 
        $('#img-view').get(0).src = img.src
        updateResults()
    } 
    async function updateResults() { 

        const inputImgEl = $('#img-view').get(0)  

        const detections = await faceapi.detectAllFaces(inputImgEl)
        console.log('JUmlah wajah: ', detections.length )
        console.log('JUmlah wajah: ', detections ) 

        /*
         * Validasi jika hanya 1 wajah saja
         */ 
        if(detections.length < 1 ){
            $('#message').text('Wajah tidak terdeteksi')
            $('.load').hide(); // Hide Process 
            return;
        }

        // Single Face 
        // if(detections.length > 1 ){
        //     $('#message').text('Hanya satu wajah saja, tidak boleh lebih')
        //     $('.load').hide(); // Hide Process 
        //     return;
        // }

        // Single Face 
        write_data_score(detections[0]._score ) 

        const faceImages = await faceapi.extractFaces(inputImgEl, detections)
        console.log('faceImages', faceImages)

        displayExtractedFaces(faceImages)
 
        $('.load').hide(); // Hide Process 
    } 

    function displayExtractedFaces(faceImages) {
        const canvas = $('#overlay').get(0)
        faceapi.matchDimensions(canvas, $('#img-view').get(0)) 

        $('#facesContainer').empty()
        faceImages.forEach( async function  (canvas)  {
            $('#facesContainer canvas').css({'margin':'2pt','padding':'2pt'}) ;
            $('#facesContainer').append(canvas) ;  
            // data_tensor = await faceapi.computeFaceDescriptor(canvas)  
            // console.log('data_tensor', data_tensor)
        })
 
    }
     
    function write_data_score(data_score){
        $('#score').val(data_score)
    }

    function write_data_tensor(data_tensor){
        $('#tensor').val(data_tensor)
    }
    
</script> 

@endsection  