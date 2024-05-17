function handledatadetail(selectedPage, element) {
  let htmlInner = ``;
  for (let item in basedataadms[selectedPage]) {
    htmlInner += `
      <tr>
        <td class="p-2">${basedataadms[selectedPage][item].id}</td>
        <td class="p-2">${basedataadms[selectedPage][item].size}</td>
        <td class="p-2"><input id="${item}-des-${basedataadms[selectedPage][item].id}" class="form-control" style="background-color: #2c2d3200; color: white;" value="${basedataadms[selectedPage][item].description}"/></td>
        <td class="p-2">
          <select id="${item}-sec-${basedataadms[selectedPage][item].id}" class="form-control  text-white" value="${basedataadms[selectedPage][item].provider}">
            <option value="adsterra" ${basedataadms[selectedPage][item].provider === "adsterra" ? 'selected' : ''}>adsterra</option>
            <option value="adsense" ${basedataadms[selectedPage][item].provider === "adsense" ? 'selected' : ''}>adsense</option>
          </select>
        </td>
        <td class="p-2">
          <textarea class="form-control  text-white border-0"  id="${item}-scr-${basedataadms[selectedPage][item].id}">${basedataadms[selectedPage][item].scripts}</textarea>
        </td>
        <td class="p-2">
          <button class="btn btn-secondary" style="background: #40a29d; border-color: #40a29d; box-shadow: 0px 2px 8px 0px rgb(196 231 229 / 0%)" onclick="saveData('${selectedPage}','${item}','${item}-des-${basedataadms[selectedPage][item].id}','${item}-sec-${basedataadms[selectedPage][item].id}','${item}-scr-${basedataadms[selectedPage][item].id}')">
            Save
          </button>
        </td>
      </tr>\n`;
  }

  element.innerHTML = htmlInner;
};
const saveData = (selectedPage, id, idhtmldes, idhtmlpro, idhtmlsri) => {
  let description = document.getElementById(idhtmldes).value;
  let provider = document.getElementById(idhtmlpro).value;
  let scripts = document.getElementById(idhtmlsri).value;

  basedataadms[selectedPage][id].description = description;
  basedataadms[selectedPage][id].provider = provider;
  basedataadms[selectedPage][id].scripts = scripts;
  // call api save
  if (description === '') description = -1
  if (scripts === '') scripts = -1



  $.post(`${window.location.origin}/endpoints/advertising-management/update-adsms-detail`, { id: basedataadms[selectedPage][id].id, provider: provider, description: description, scripts: scripts }, function (data) {
    if (data.status == 200) {
      location.reload()
    } else if (data.status == 300) {
      console.log('error:::', data);
    }
  });
};


function getAllData(hash_id) {
  return new Promise((resolve, reject) => {
    $.get(`${window.location.origin}/endpoints/advertising-management/get-adsms-all`, { hash_id: hash_id }, function (data) {
      if (data.status == 200) {
        resolve(data.data); // Trả về dữ liệu khi yêu cầu thành công
      } else if (data.status == 300) {
        reject('Error'); // Bắt lỗi nếu yêu cầu không thành công
      }
    });
  });
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