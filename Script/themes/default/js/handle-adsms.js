

function resadsms(type, hash_id) {
          return new Promise((resolve, reject) => {
                    $.get(ajaxUrl() + "/advertising-management/get-adsms-detail", { hash_id: hash_id, type: type }, function (data, textStatus, xhr) {
                              if (data.status == 200) {
                                        resolve(data.data); // Trả về dữ liệu khi yêu cầu thành công
                              } else if (data.status == 300) {
                                        reject('Error'); // Bắt lỗi nếu yêu cầu không thành công
                              }
                    });
          });
}
function extractScriptsData(input) {
          // Tạo một biểu thức chính quy để trích xuất dữ liệu từ chuỗi đầu vào
          const srcRegex = /src\s*=\s*"([^"]+)"/;
          const atOptionsRegex = /atOptions\s*=\s*{([^}]+)}/;
          // Dùng exec để tìm kiếm các kết quả phù hợp với biểu thức chính quy
          const srcMatches = srcRegex.exec(input);
          let atOptionsMatches = atOptionsRegex.exec(input);
          atOptionsMatches[0] = atOptionsMatches[0] + '\n}'

          // Nếu có kết quả, trích xuất và trả về dữ liệu
          if (atOptionsMatches && atOptionsMatches) {
                    const atOptions = atOptionsMatches[0];
                    const src = srcMatches[1];
                    return { atOptions, src };
          } else {
                    // Nếu không tìm thấy, trả về null hoặc thông báo lỗi
                    return null;
          }
}
function convertToHTML(text) {
          // Thay thế các ký tự đặc biệt bằng các ký tự tương ứng
          text = text.replace(/&lt;/g, '<');
          text = text.replace(/&gt;/g, '>');
          text = text.replace(/&amp;/g, '&');
          text = text.replace(/&quot;/g, '"');
          text = text.replace(/&#039;/g, "'");
          text = text.replace(/<br>/g, '\n'); // Thay thế <br> bằng dấu xuống dòng
          return text;
}
function insertScripts(scriptsHTML, containerId) {
          // Tạo một phần tử script mới cho atOptions
          const atOptionsScript = document.createElement("script");
          atOptionsScript.type = "text/javascript";
          atOptionsScript.innerHTML = scriptsHTML.atOptions;

          // Tạo một phần tử script mới cho src
          const srcScript = document.createElement("script");
          srcScript.type = "text/javascript";
          srcScript.src = scriptsHTML.src;

          // Lấy phần tử container dựa trên ID
          const container = document.getElementById(containerId);

          // Nếu container tồn tại, thêm các phần tử script vào đó
          if (container) {
                    container.appendChild(atOptionsScript);
                    container.appendChild(srcScript);
          } else {
                    console.error("Không tìm thấy phần tử container với ID đã cho.");
          }
}