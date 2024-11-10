function menuAuthListRender(data, type, full, meta, column, param) {
    const th = document.querySelector(`.datatables-records thead th:nth-child(${meta.col+1})`);
    if(!th.classList.contains('bg-warning')) th.classList.add('bg-warning');
    if(full['menu_auth'].includes(param.menu_id)) {
        return 'Y';
    }else{
        return 'N';
    }
}
