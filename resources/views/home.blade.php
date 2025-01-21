<x-app-layout>

    <div class="mt-5">
      <div class="container">

        <div class="row sub-menu">
          <div class="col-md-4 my-0">
            <div class="d-flex bg-green-600 mt-10 justify-content-center flex-column align-items-center">
              <h3 class="h3">Greeting for Subscribers</h3>
              <div class="d-flex justify-content-center align-items-center">
              <div class="col-md-1">
                <label id="file-name"  for="file-input"> File</label>
              </div>
              <div class="col-md-11">
                <div class="custom-file mx-3">
                  <label id="file-name" class="file-label play" for="file-input">choose File</label>
                  <input type="file" id="file-input" accept="audio/mp3,audio/*;capture=microphone"  class="file-input" />
                </div>
              </div>
                
              </div>
              <a id="replace-file-text" class="text-decoration  no-style" href="javascript:void(0)">Replace</a>
              <input id="replace-file-input" accept="audio/mp3,audio/*;capture=microphone" name="sub_audio" type="file" style="display:none" class="replace-img" />
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
                  <input type="file" id="file-input" accept="audio/mp3,audio/*;capture=microphone" class="file-input" />
                </div>
              </div>
                
              </div>
              <a id="replace-file-non-sub-text" class="text-decoration  no-style" href="javascript:void(0)">Replace</a>
              <input id="replace-non-file-input" accept="audio/mp3,audio/*;capture=microphone" name="non_sub_audio" type="file" style="display:none" class="replace-img" />
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
                      </select>
                  
                  </div>
                  
                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                      <label for="">To</label>
                      <input type="text" class="w-100 " placeholder="+1123355656" />
                  </div>

                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                    <label for="">Enter afer (minutes)</label>
                    <input type="number" readonly class="w-100 " value="60" />
                  </div>
                </div>
              
              </div>
              <div class="col-md-4 ">
                <div class="d-flex justify-content-center align-items-center flex-column">
                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                  
                      <label for="">Function</label>
                      <select name="cars" id="cars" class="play">
                        <option value="volvo">Play MP3</option>
                      </select>
                  </div>
                
                  <a id="option-2-replace-file-text" class="text-decoration" href="javascript:void(0)">Replace</a>
                  <input id="option-2-replace-file-input" type="file" name="option_2_replace" style="display:none" class="replace-img" accept="audio/mp3,audio/*;capture=microphone" />
                </div>
              
              </div>
              <div class="col-md-4 ">
                <div class="d-flex justify-content-center align-items-center flex-column">
                <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                
                    <label for="">Function</label>
            
                    <select name="cars" id="cars" form="" class="play">
                      <option value="volvo">Play MP3</option>
                    </select>
                </div>
                
                <a id="option-3-replace-file-text" class="text-decoration" href="javascript:void(0)">Replace</a>
                <input id="option-3-replace-file-input" type="file" style="display:none" class="replace-img" accept="audio/mp3,audio/*;capture=microphone" />
                </div>
              
              </div>

              <div class="col-md-4 mt-5 ">
                <div class="d-flex justify-content-center align-items-center flex-column">
                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                    <label for="">Function</label>
                
                    <select name="cars" id="cars" form="" class="play">
                      <option value="volvo">Play MP3</option>
                    </select>
                  </div>
                  
                  <a id="option-4-replace-file-text" class="text-decoration" href="javascript:void(0)">Replace</a>
                  <input id="option-4-replace-file-input" type="file" name="option_4_replace" style="display:none" class="replace-img" accept="audio/mp3,audio/*;capture=microphone" />
                </div>
              
              </div>
              <div class="col-md-4 mt-5 ">
                <div class="d-flex justify-content-center align-items-center flex-column">
                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                
                    <label for="">Function</label>
                
                    <select name="cars" id="cars" class="play">
                      <option value="volvo">None</option>
                    </select>
                  
                  </div>
                </div>
              
              </div>
              <div class="col-md-4 mt-5 ">
                <div class="d-flex justify-content-center align-items-center flex-column">
                  
                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                      <label for="">Function</label>
                      <select name="cars" id="cars" class="play form-select" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <option value="submenu">Sub-menu</option>
                      </select>
                  </div>
                  <a id="replace-file-text" class="text-decoration" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="javascript:void(0)">Edit Submenu</a>
                </div>
              
              </div>
              <div class="col-md-4 mt-5 ">
                <div class="d-flex justify-content-center align-items-center flex-column">
                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                
                    <label for="">Function</label>
              
                
                    <select name="cars" id="cars" form="" class="play">
                      <option value="volvo">None</option>
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
                      </select>
                  </div>
                  
                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                      <label for="">To</label>
                      <input type="text" class="w-100" name="option_9" placeholder="+1123355656" />
                  </div>

                  <div class="d-flex justify-content-center align-items-center mt-2 w-100">
                    <label for="">Enter afer (minutes)</label>
                    <input type="number" readonly class="w-100" value="2" />
                  </div>
                </div>
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          
          <div class="modal-body">
            <div class="mt-5">
              <div class="container-fluid">
          
                <div class="row sub-menu">
                  <div class="col-md-4 my-0">
                    <div class="d-flex bg-green-600 mt-10 justify-content-center flex-column align-items-center">
                      <h3 class="h3">Greeting for Sub-menu 6</h3>
                      <div class="d-flex justify-content-center align-items-center">
                        <div class="col-md-1">
                          <label id="file-name" for="file-input"> File</label>
                        </div>
                        <div class="col-md-11">
                          <div class="custom-file mx-3">
                            <label id="file-name" class="file-label play" for="file-input">choose File</label>
                            <input type="file" id="file-input" class="file-input" />
                          </div>
                        </div>
                      </div>
                      <a id="replace-file-text" class="text-decoration  no-style" href="javascript:void(0)">Replace File</a>
                      <input id="replace-file-input" type="file" style="display:none" class="replace-img" />
                    </div>
          
                  </div>
          
                  <div class="col-md-8 py-5 bg-green-600">
                    <div class="row">
                      <div class="col-md-4">
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
          
                            <label id="file-name" for="file-input">File</label>
          
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
          
                            <label id="file-name" for="file-input">File</label>
          
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
          
                            <label id="file-name" for="file-input">File</label>
          
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
          
                            <label id="file-name" for="file-input">File</label>
          
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
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Understood</button>
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

      <script>
        // Get the elements by their correct IDs
            const replaceFileNonSubText = document.getElementById('replace-file-non-sub-text');
            const replaceNonFileInput = document.getElementById('replace-non-file-input');
        
            // Add a click event to the link to trigger the file input
            replaceFileNonSubText.addEventListener('click', () => {
              replaceNonFileInput.click(); // Simulate a click on the hidden file input
            });
        
            // Add a change event to the file input to display the selected file name
            replaceNonFileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                replaceFileText.textContent = file ? file.name : 'No file chosen';
            });
      </script>

      {{-- option 1 --}}
      <script>
        // Get the elements by their correct IDs
        const transferReplaceFileText = document.getElementById('transfer-replace-file-text');
            const transferReplaceFileInput = document.getElementById('transfer-replace-file-input');
        
            // Add a click event to the link to trigger the file input
            transferReplaceFileText.addEventListener('click', () => {
              transferReplaceFileInput.click(); // Simulate a click on the hidden file input
            });
        
            // Add a change event to the file input to display the selected file name
            transferReplaceFileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                replaceFileText.textContent = file ? file.name : 'No file chosen';
            });
      </script>


      {{-- option 2 --}}
      <script>
        // Get the elements by their correct IDs
        const optionTwoReplaceFileText = document.getElementById('option-2-replace-file-text');
            const optionTwoReplaceFileInput = document.getElementById('option-2-replace-file-input');
        
            // Add a click event to the link to trigger the file input
            optionTwoReplaceFileText.addEventListener('click', () => {
              optionTwoReplaceFileInput.click(); // Simulate a click on the hidden file input
            });
        
            // Add a change event to the file input to display the selected file name
            optionTwoReplaceFileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                optionTwoReplaceFileText.textContent = file ? file.name : 'No file chosen';
            });
      </script>

      {{-- option 3 --}}
      <script>
        // Get the elements by their correct IDs
        const optionThreeReplaceFileText = document.getElementById('option-3-replace-file-text');
            const optionThreeReplaceFileInput = document.getElementById('option-3-replace-file-input');
        
            // Add a click event to the link to trigger the file input
            optionThreeReplaceFileText.addEventListener('click', () => {
              optionThreeReplaceFileInput.click(); // Simulate a click on the hidden file input
            });
        
            // Add a change event to the file input to display the selected file name
            optionThreeReplaceFileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                optionThreeReplaceFileText.textContent = file ? file.name : 'No file chosen';
            });
      </script>

      {{-- option 4 --}}
      <script>
        // Get the elements by their correct IDs
        const optionFourReplaceFileText = document.getElementById('option-4-replace-file-text');
            const optionFourReplaceFileInput = document.getElementById('option-4-replace-file-input');
        
            // Add a click event to the link to trigger the file input
            optionFourReplaceFileText.addEventListener('click', () => {
              optionFourReplaceFileInput.click(); // Simulate a click on the hidden file input
            });
        
            // Add a change event to the file input to display the selected file name
            optionFourReplaceFileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                optionFourReplaceFileText.textContent = file ? file.name : 'No file chosen';
            });
      </script>

      
    
</x-app-layout>