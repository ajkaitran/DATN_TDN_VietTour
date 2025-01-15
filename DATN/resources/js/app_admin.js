import $ from 'jquery';
window.$ = window.jQuery = $;

const INPUT_FILE = document.querySelector('#upload-files');
const INPUT_CONTAINER = document.querySelector('#upload-container');
const FILES_LIST_CONTAINER = document.querySelector('#files-list-container');
const FILE_LIST = [];
let UPLOADED_FILES = [];

const multipleEvents = (element, eventNames, listener) => {
  const events = eventNames.split(' ');

  events.forEach(event => {
    element.addEventListener(event, listener, false);
  });
};

const previewImages = () => {
  FILES_LIST_CONTAINER.innerHTML = '';
  if (FILE_LIST.length > 0) {
    FILE_LIST.forEach((addedFile, index) => {
      const content = `
        <div class="form__image-container js-remove-image" data-index="${index}">
          <img class="form__image" src="${addedFile.url}" alt="${addedFile.name}">
        </div>
      `;

      FILES_LIST_CONTAINER.insertAdjacentHTML('beforeEnd', content);
    });
  } else {
    console.log('empty');
    INPUT_FILE.value = "";
  }
};

const fileUpload = () => {
  if (FILES_LIST_CONTAINER) {
    multipleEvents(INPUT_FILE, 'click dragstart dragover', () => {
      INPUT_CONTAINER.classList.add('active');
    });

    multipleEvents(INPUT_FILE, 'dragleave dragend drop change blur', () => {
      INPUT_CONTAINER.classList.remove('active');
    });

    INPUT_FILE.addEventListener('change', () => {
      const files = [...INPUT_FILE.files];
      console.log("changed");
      files.forEach(file => {
        const fileURL = URL.createObjectURL(file);
        const fileName = file.name;
        if (!file.type.match("image/")) {
          alert(file.name + " is not an image");
          console.log(file.type);
        } else {
          const uploadedFiles = {
            name: fileName,
            url: fileURL
          };


          FILE_LIST.push(uploadedFiles);
        }
      });

      console.log(FILE_LIST); //final list of uploaded files
      previewImages();
      UPLOADED_FILES = document.querySelectorAll(".js-remove-image");
      removeFile();
    });
  }
};

const removeFile = () => {
  UPLOADED_FILES = document.querySelectorAll(".js-remove-image");

  if (UPLOADED_FILES) {
    UPLOADED_FILES.forEach(image => {
      image.addEventListener('click', function () {
        const fileIndex = this.getAttribute('data-index');

        FILE_LIST.splice(fileIndex, 1);
        previewImages();
        removeFile();
      });
    });
  } else {
    [...INPUT_FILE.files] = [];
  }
};

fileUpload();
removeFile();

CKEDITOR.replace('editor');
CKEDITOR.replace('editor1');
CKEDITOR.replace('editor2');
CKEDITOR.replace('editor3');
CKEDITOR.replace('editor4');
CKEDITOR.replace('editor5');
CKEDITOR.replace('editor6');
CKEDITOR.replace('editor7');
CKEDITOR.replace('editor8');
CKEDITOR.replace('editor9');
CKEDITOR.replace('editor10');
CKEDITOR.replace('editor11');


// function updateUser(id) {
//   let row = $('tr[data-id="' + id + '"]');
//   let role = row.find('select#role').val();
//   let status = row.find('input#status').prop('checked') ? 1 : 0;

//   $.post("{{ route('admin.quickUpdate') }}", {
//     id: id,
//     role: role,
//     status: status,
//     _token: '{{ csrf_token() }}'
//   }, function (response) {
//     if (response.success) {
//       $.toast({
//         text: response.message,
//         position: 'bottom-right',
//         icon: 'success',
//       });
//     } else {
//       $.toast({
//         text: response.message,
//         position: 'bottom-right',
//         icon: 'error',
//       });
//     }
//   });
// }

// function deleteUser(id) {
//   if (confirm('Bạn có chắc chắn muốn xóa tài khoản này không?')) {
//     $.post("{{ route('admin.destroy') }}", {
//       id: id,
//       _token: '{{ csrf_token() }}'
//     }, function (response) {
//       if (response.success) {
//         $('tr[data-id="' + id + '"]').fadeOut();
//         $.toast({
//           text: response.message,
//           position: 'bottom-right',
//           icon: 'success',
//         });
//       } else {
//         $.toast({
//           text: response.message,
//           position: 'bottom-right',
//           icon: 'error',
//         });
//       }
//     });
//   }
// }

$(document).ready(function () {
  $('#upload-files').on('change', function () {
    const previewImage = document.getElementById('preview-image');

    if (this.files.length === 0) {
      previewImage.style.display = 'block';
    } else {
      previewImage.style.display = 'none';
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Hiển thị hình ảnh khi chọn tệp trên desktop
  document.getElementById('upload-files').addEventListener('change', function(event) {
      var desktopShow = document.querySelector('.desktop-show');
      desktopShow.innerHTML = '';  // Xóa tất cả ảnh trước đó

      // Duyệt qua tất cả các tệp được chọn
      Array.from(event.target.files).forEach(function(file, index) {
          var reader = new FileReader();

          reader.onload = function(e) {
              // Tạo HTML cho mỗi ảnh đã chọn
              var imageContainer = document.createElement('div');
              imageContainer.classList.add('form__image-container');
              imageContainer.setAttribute('data-index', index);

              var imgElement = document.createElement('img');
              imgElement.classList.add('form__image');
              imgElement.src = e.target.result;
              imgElement.alt = file.name;

              var removeButton = document.createElement('span');
              removeButton.classList.add('js-remove-image');
              // removeButton.textContent = 'X';

              // Tạo sự kiện click trên toàn bộ phần tử ảnh (image container)
              imageContainer.addEventListener('click', function() {
                  imageContainer.remove();  // Xóa ảnh khi click vào phần tử chứa ảnh
              });

              imageContainer.appendChild(imgElement);
              imageContainer.appendChild(removeButton);
              desktopShow.appendChild(imageContainer);  // Thêm vào phần hiển thị
          };

          reader.readAsDataURL(file);
      });
  });

  // Hiển thị hình ảnh khi chọn tệp trên mobile
  document.getElementById('image_mobile').addEventListener('change', function(event) {
      var mobileShow = document.querySelector('.mobile-show');
      mobileShow.innerHTML = '';  // Xóa tất cả ảnh trước đó

      var file = event.target.files[0];
      if (file) {
          var reader = new FileReader();
          reader.onload = function(e) {
              // Tạo HTML cho ảnh đã chọn trên mobile
              var imageContainer = document.createElement('div');
              imageContainer.classList.add('form__image-container');
              imageContainer.setAttribute('data-index', 0);

              var imgElement = document.createElement('img');
              imgElement.classList.add('form__image');
              imgElement.src = e.target.result;
              imgElement.alt = file.name;

              var removeButton = document.createElement('span');
              removeButton.classList.add('js-remove-image');
              // removeButton.textContent = 'X';

              // Tạo sự kiện click trên toàn bộ phần tử ảnh (image container)
              imageContainer.addEventListener('click', function() {
                  imageContainer.remove();  // Xóa ảnh khi click vào phần tử chứa ảnh
              });

              imageContainer.appendChild(imgElement);
              imageContainer.appendChild(removeButton);
              mobileShow.appendChild(imageContainer);  // Thêm vào phần hiển thị
          };
          reader.readAsDataURL(file);
      }
  });
});

document.getElementById('TimeDetail').addEventListener('change', function () {
  // Ẩn tất cả các nhóm `data-count`
  document.querySelectorAll("[data-count]").forEach(function (el) {
      el.style.display = 'none';
  });

  // Hiển thị các nhóm tương ứng với giá trị được chọn
  var num = this.options[this.selectedIndex].getAttribute('data-time');
  for (var i = 1; i <= num; i++) {
      document.querySelectorAll("[data-count='" + i + "']").forEach(function (el) {
          el.style.display = 'block';
      });
  }
});

