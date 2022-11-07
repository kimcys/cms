/*
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7 & Bootstrap 4.0.0-Alpha 6
Version: 3.0.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin-v3.0/admin/apple/
*/

// white
var white = 'rgba(255,255,255,1.0)';
var fillBlack = 'rgba(17, 17, 17, 0.6)';
var fillBlackLight = 'rgba(17, 17, 17, 0.2)';
var strokeBlack = 'rgba(17, 17, 17, 0.8)';
var highlightFillBlack = 'rgba(17, 17, 17, 0.8)';
var highlightStrokeBlack = 'rgba(17, 17, 17, 1)';

// blue
var fillBlue = 'rgba(52, 143, 226, 0.6)';
var fillBlueLight = 'rgba(52, 143, 226, 0.2)';
var strokeBlue = 'rgba(52, 143, 226, 0.8)';
var highlightFillBlue = 'rgba(52, 143, 226, 0.8)';
var highlightStrokeBlue = 'rgba(52, 143, 226, 1)';

// grey
var fillGrey = 'rgba(78, 78, 78, 0.6)';
var fillGreyLight = 'rgba(78, 78, 78, 0.2)';
var strokeGrey = 'rgba(78, 78, 78, 0.8)';
var highlightFillGrey = 'rgba(78, 78, 78, 0.8)';
var highlightStrokeGrey = 'rgba(78, 78, 78, 1)';

// green
var fillGreen = 'rgba(76, 217, 100, 0.6)';
var fillGreenLight = 'rgba(76, 217, 100, 0.2)';
var strokeGreen = 'rgba(76, 217, 100, 0.8)';
var highlightFillGreen = 'rgba(76, 217, 100, 0.8)';
var highlightStrokeGreen = 'rgba(76, 217, 100, 1)';

// purple
var fillPurple = 'rgba(88, 86, 214, 0.6)';
var fillPurpleLight = 'rgba(88, 86, 214, 0.2)';
var strokePurple = 'rgba(88, 86, 214, 0.8)';
var highlightFillPurple = 'rgba(88, 86, 214, 0.8)';
var highlightStrokePurple = 'rgba(88, 86, 214, 1)';


var randomScalingFactor = function() { 
    return Math.round(Math.random()*100)
};

var lineChartData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [{
        label: 'Dataset 1',
        borderColor: strokeBlue,
        pointBackgroundColor: strokeBlue,
        pointRadius: 2,
        borderWidth: 2,
        backgroundColor: fillBlueLight,
        data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
    }, {
        label: 'Dataset 2',
        borderColor: strokeBlack,
        pointBackgroundColor: strokeBlack,
        pointRadius: 2,
        borderWidth: 2,
        backgroundColor: fillBlackLight,
        data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
    }]
};

var barChartData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [{
        label: 'Dataset 1',
        borderWidth: 2,
        borderColor: strokePurple,
        backgroundColor: fillPurpleLight,
        data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
    }, {
        label: 'Dataset 2',
        borderWidth: 2,
        borderColor: strokeBlack,
        backgroundColor: fillBlackLight,
        data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
    }]
};

var radarChartData = {
    labels: ['Eating', 'Drinking', 'Sleeping', 'Designing', 'Coding', 'Cycling', 'Running'],
    datasets: [{
        label: 'Dataset 1',
        borderWidth: 2,
        borderColor: strokePurple,
        pointBackgroundColor: strokePurple,
        pointRadius: 2,
        backgroundColor: fillPurpleLight,
        data: [65,59,90,81,56,55,40]
    }, {
        label: 'Dataset 2',
        borderWidth: 2,
        borderColor: strokeBlack,
        pointBackgroundColor: strokeBlack,
        pointRadius: 2,
        backgroundColor: fillBlackLight,
        data: [28,48,40,19,96,27,100]
    }]
};

var polarAreaData = {
    labels: ['Purple', 'Blue', 'Green', 'Grey', 'Black'],
    datasets: [{
        data: [300, 160, 100, 200, 120],
        backgroundColor: [fillPurple, fillBlue, fillGreen, fillGrey, fillBlack],
        borderColor: [strokePurple, strokeBlue, strokeGreen, strokeGrey, strokeBlack],
        borderWidth: 2,
        label: 'My dataset'
    }]
};

var pieChartData = {
    labels: ['Purple', 'Blue', 'Green', 'Grey', 'Black'],
    datasets: [{
        data: [300, 50, 100, 40, 120],
        backgroundColor: [fillPurple, fillBlue, fillGreen, fillGrey, fillBlack],
        borderColor: [strokePurple, strokeBlue, strokeGreen, strokeGrey, strokeBlack],
        borderWidth: 2,
        label: 'My dataset'
    }]
};

var doughnutChartData = {
    labels: ['Purple', 'Blue', 'Green', 'Grey', 'Black'],
    datasets: [{
        data: [300, 50, 100, 40, 120],
        backgroundColor: [fillPurple, fillBlue, fillGreen, fillGrey, fillBlack],
        borderColor: [strokePurple, strokeBlue, strokeGreen, strokeGrey, strokeBlack],
        borderWidth: 2,
        label: 'My dataset'
    }]
};

var handleChartJs = function() {
    var ctx = document.getElementById('line-chart').getContext('2d');
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: lineChartData
    });
    
    var ctx2 = document.getElementById('bar-chart').getContext('2d');
    var barChart = new Chart(ctx2, {
        type: 'bar',
        data: barChartData
    });
    
    var ctx3 = document.getElementById('radar-chart').getContext('2d');
    var radarChart = new Chart(ctx3, {
        type: 'radar',
        data: radarChartData
    });
    
    var ctx4 = document.getElementById('polar-area-chart').getContext('2d');
    var polarAreaChart = new Chart(ctx4, {
        type: 'polarArea',
        data: polarAreaData
    });
    
    var ctx5 = document.getElementById('pie-chart').getContext('2d');
    window.myPie = new Chart(ctx5, {
        type: 'pie',
        data: pieChartData
    });
    
    var ctx6 = document.getElementById('doughnut-chart').getContext('2d');
    window.myDoughnut = new Chart(ctx6, {
        type: 'doughnut',
        data: doughnutChartData
    });
};

var ChartJs = function () {
	"use strict";
    return {
        //main function
        init: function () {
            handleChartJs();
        }
    };
}();