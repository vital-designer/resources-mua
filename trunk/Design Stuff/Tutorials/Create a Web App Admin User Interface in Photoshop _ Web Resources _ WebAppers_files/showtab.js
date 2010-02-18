function changeTab(tabno) {

if (tabno == '1') {
document.getElementById('RecommendTab').innerHTML = document.getElementById('MostRecommend').innerHTML;document.getElementById('tabname1').className='tabformat';
document.getElementById('tabname2').className='tabformat2';document.getElementById('tabname3').className='tabformat2';
return false;
}

if (tabno == '2') {
document.getElementById('RecommendTab').innerHTML = document.getElementById('RecentComments').innerHTML;document.getElementById('tabname2').className='tabformat';
document.getElementById('tabname1').className='tabformat2';document.getElementById('tabname3').className='tabformat2';
return false;
}

if (tabno == '3') {
document.getElementById('RecommendTab').innerHTML = document.getElementById('MostRandom').innerHTML;document.getElementById('tabname3').className='tabformat';
document.getElementById('tabname1').className='tabformat2';document.getElementById('tabname2').className='tabformat2';
return false;
}


}
