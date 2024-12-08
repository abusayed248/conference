<x-app-layout>

    <div class="mt-5">
      <div class="container">

        <div class="row sub-menu">
          <div class="col-md-4 my-0">
            <div class="d-flex bg-green-600 mt-10 justify-content-center flex-column align-items-center">
              <h3 class="h3">Greeting for Sub-menu</h3>
              <div class="d-flex justify-content-center align-items-center">
              <div class="col-md-1">
                <label id="file-name"  for="file-input"> File</label>
              </div>
              <div class="col-md-11">
                <div class="custom-file mx-3">
                  <label id="file-name" class="file-label play" for="file-input">choose File</label>
                  <input type="file" id="file-input" class="file-input" />
                </div>
              </div>
                
              </div>
              <a id="replace-file-text" class="text-decoration  no-style" href="javascript:void(0)">Replace</a>
              <input id="replace-file-input" type="file" style="display:none" class="replace-img" />
            </div>
            <div class="d-flex mt-5 justify-content-center flex-column align-items-center">
              <h3 class="h3">Greeting for non-subscribers</h3>
              <div class="d-flex justify-content-center align-items-center">
              <div class="col-md-1">
                <label id="file-name"  for="file-input"> File</label>
              </div>
              <div class="col-md-11">
                <div class="custom-file mx-3">
                  <label id="file-name" class="file-label play" for="file-input">choose File</label>
                  <input type="file" id="file-input" class="file-input" />
                </div>
              </div>
                
              </div>
              <a id="replace-file-text" class="text-decoration  no-style" href="javascript:void(0)">Replace</a>
              <input id="replace-file-input" type="file" style="display:none" class="replace-img" />
            </div>

            <div class="mt-5 d-flex justify-content-center">
              <h3><a class="text-center large-text text-decoration" href="{{ route('manage.subscribers') }}">Manage Subscribers</a></h3>
            </div>
          </div>

          <div class="col-md-8 py-5 bg-green-600">
            <div class="row">
              <div class="col-md-4">
                <div class="d-flex justify-content-center align-items-center flex-column">
                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                  
                      <label for="">Function</label>
              
                      <select name="cars" id="cars" form="" class="play">
                        <option value="volvo">Transfer</option>
                        <option value="saab">Saab</option>
                        <option value="opel">Opel</option>
                        <option value="audi">Audi</option>
                      </select>
                  
                  </div>
                  
                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                      <label for="">To</label>
                      <input type="text" class="w-100 " placeholder="+1123355656" />
                  </div>
                  <a id="replace-file-text" class="text-decoration" href="javascript:void(0)">Replace</a>
                  <input id="replace-file-input" type="file" style="display:none" class="replace-img" />

                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                    <label for="">Enter afer (minutes)</label>
                    <input type="number" class="w-100 " placeholder="60" />
                  </div>
                </div>
              
              </div>
              <div class="col-md-4 ">
                <div class="d-flex justify-content-center align-items-center flex-column">
                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                
                    <label for="">Function</label>
                
                    <select name="cars" id="cars" class="play">
                      <option value="volvo">Play MP3</option>
                      <option value="saab">Saab</option>
                      <option value="opel">Opel</option>
                      <option value="audi">Audi</option>
                    </select>
                
                </div>
                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
              
                    <label id="file-name"  for="file-input">File</label>
                
                    <div class="custom-file l-magin">
                      <label id="file-name" class="file-label play" for="file-input">choose File</label>
                      <input type="file" id="file-input" class="file-input" />
                    </div>
                
                  </div>
                  <a id="replace-file-text" class="text-decoration" href="javascript:void(0)">Replace</a>
                  <input id="replace-file-input" type="file" style="display:none" class="replace-img" />
                </div>
              
              </div>
              <div class="col-md-4 ">
                <div class="d-flex justify-content-center align-items-center flex-column">
                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                
                    <label for="">Function</label>
            
                
                    <select name="cars" id="cars" form="" class="play">
                      <option value="volvo">Play MP3</option>
                      <option value="saab">Saab</option>
                      <option value="opel">Opel</option>
                      <option value="audi">Audi</option>
                    </select>
                
                </div>
                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
              
                    <label id="file-name"  for="file-input">File</label>
                
                    <div class="custom-file l-magin">
                      <label id="file-name" class="file-label play" for="file-input">choose File</label>
                      <input type="file" id="file-input" class="file-input" />
                    </div>
                
                  
                    
                  </div>
                  <a id="replace-file-text" class="text-decoration" href="javascript:void(0)">Replace</a>
                  <input id="replace-file-input" type="file" style="display:none" class="replace-img" />
                </div>
              
              </div>

              <div class="col-md-4 mt-5 ">
                <div class="d-flex justify-content-center align-items-center flex-column">
                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                
                    <label for="">Function</label>
              
                
                    <select name="cars" id="cars" form="" class="play">
                      <option value="volvo">Play MP3</option>
                      <option value="saab">Saab</option>
                      <option value="opel">Opel</option>
                      <option value="audi">Audi</option>
                    </select>
                  
                  </div>
                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                
                    <label id="file-name"  for="file-input">File</label>
                
                    <div class="custom-file l-magin">
                      <label id="file-name" class="file-label play" for="file-input">choose File</label>
                      <input type="file" id="file-input" class="file-input" />
                    </div>
                
                  
                    
                  </div>
                  <a id="replace-file-text" class="text-decoration" href="javascript:void(0)">Replace</a>
                  <input id="replace-file-input" type="file" style="display:none" class="replace-img" />
                </div>
              
              </div>
              <div class="col-md-4 mt-5 ">
                <div class="d-flex justify-content-center align-items-center flex-column">
                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                
                    <label for="">Function</label>
              
                
                    <select name="cars" id="cars" form="" class="play">
                      <option value="volvo">None</option>
                      <option value="saab">Saab</option>
                      <option value="opel">Opel</option>
                      <option value="audi">Audi</option>
                    </select>
                  
                  </div>
                </div>
              
              </div>
              <div class="col-md-4 mt-5 ">
                <div class="d-flex justify-content-center align-items-center flex-column">
                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                
                    <label for="">Function</label>
              
                
                    <select name="cars" id="cars" form="" class="play">
                      <option value="volvo">None</option>
                      <option value="saab">Saab</option>
                      <option value="opel">Opel</option>
                      <option value="audi">Audi</option>
                    </select>
                  
                  </div>
              
                </div>
              
              </div>
              <div class="col-md-4 mt-5 ">
                <div class="d-flex justify-content-center align-items-center flex-column">
                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                
                    <label for="">Function</label>
              
                
                    <select name="cars" id="cars" form="" class="play">
                      <option value="volvo">None</option>
                      <option value="saab">Saab</option>
                      <option value="opel">Opel</option>
                      <option value="audi">Audi</option>
                    </select>
                  
                  </div>
                </div>
              
              </div>
              <div class="col-md-4 mt-5 ">
                <div class="d-flex justify-content-center align-items-center flex-column">
                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                
                    <label for="">Function</label>
              
                
                    <select name="cars" id="cars" form="" class="play">
                      <option value="Play MP3">Play MP3</option>
                      <option value="Transfer">Transfer</option>
                      <option value="Submenu">Submenu</option>
                    </select>
                  
                  </div>
                </div>
              
              </div>
              <div class="col-md-4">
                <div class="d-flex justify-content-center align-items-center flex-column">
                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                  
                      <label for="">Function</label>
              
                      <select name="cars" id="cars" form="" class="play">
                        <option value="volvo">Transfer</option>
                        <option value="saab">Saab</option>
                        <option value="opel">Opel</option>
                        <option value="audi">Audi</option>
                      </select>
                  
                  </div>
                  
                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                      <label for="">To</label>
                      <input type="text" class="w-100 " placeholder="+1123355656" />
                  </div>
                  <a id="replace-file-text" class="text-decoration" href="javascript:void(0)">Replace</a>
                  <input id="replace-file-input" type="file" style="display:none" class="replace-img" />

                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                    <label for="">Enter afer (minutes)</label>
                    <input type="number" class="w-100 " placeholder="60" />
                  </div>
                </div>
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
        

      <script>
        // Get the elements by their correct IDs
            const replaceFileText = document.getElementById('replace-file-text');
            const replaceFileInput = document.getElementById('replace-file-input');
        
            // Add a click event to the link to trigger the file input
            replaceFileText.addEventListener('click', () => {
                replaceFileInput.click(); // Simulate a click on the hidden file input
            });
        
            // Add a change event to the file input to display the selected file name
            replaceFileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                replaceFileText.textContent = file ? file.name : 'No file chosen';
            });
        </script>
    
</x-app-layout>