var morrisCharts = function() {

    Morris.Line({
      element: 'morris-line-example1',
      data: [
        { w: 'Week1', a: 100},
        { w: 'Week2', a: 205},
        { w: 'Week3', a: 150},
        { w: 'Week4', a: 55},
        { w: 'Week5', a: 50},
        { w: 'Week6', a: 75},
        { w: 'Week7', a: 200},
        { w: 'Week8', a: 110},
        { w: 'Week9', a: 130},
        { w: 'Week10', a: 90},
        { w: 'Week11', a: 80},
        { w: 'Week12', a: 100}
      ],
      xkey: 'w',
      ykeys: ['a'],
      parseTime: false,
      labels: ['Weight'],
      resize: true,
      lineColors: ['#33414E']
    });

    Morris.Line({
      element: 'morris-line-example2',
      data: [
        { w: 'Week1', p: 10},
        { w: 'Week2', p: 10},
        { w: 'Week3', p: 30},
        { w: 'Week4', p: 20},
        { w: 'Week5', p: 25},
        { w: 'Week6', p: 15},
        { w: 'Week7', p: 40},
        { w: 'Week8', p: 45},
        { w: 'Week9', p: 20},
        { w: 'Week10', p: 15},
        { w: 'Week11', p: 45},
        { w: 'Week12', p: 50}
      ],
      xkey: 'w',
      ykeys: ['p'],
      parseTime: false,
      labels: ['Body Fat'],
      resize: true,
      lineColors: ['#95B75D']
    });

    Morris.Line({
      element: 'morris-line-example3',
      data: [
        { w: 'Week1', a: 100, b: 90, c: 65, d: 90, e: 50, f: 180, g: 40, h: 80, i: 50 },
        { w: 'Week2', a: 75,  b: 65, c: 30, d: 90, e: 50, f: 70, g: 95, h: 70, i: 100 },
        { w: 'Week3', a: 50,  b: 40, c: 130, d: 95, e: 50, f: 80, g: 65, h: 80, i: 95 },
        { w: 'Week4', a: 75,  b: 65, c: 30, d: 90, e: 50, f: 70, g: 50, h: 150, i: 80 },
        { w: 'Week5', a: 50,  b: 40, c: 130, d: 165, e: 65, f: 150, g: 40, h: 195, i: 100 },
        { w: 'Week6', a: 75,  b: 65, c: 30, d: 70, e: 95, f: 70, g: 40, h: 80, i: 70 },
        { w: 'Week7', a: 100, b: 90, c: 30, d: 90, e: 50, f: 50, g: 50, h: 70, i: 80 },
        { w: 'Week8', a: 120, b: 100, c: 30, d: 90, e: 50, f: 70, g: 40, h: 65, i: 100 },
        { w: 'Week9', a: 160, b: 80, c: 130, d: 90, e: 50, f: 70, g: 40, h: 180, i: 100 },
        { w: 'Week10', a: 115, b: 50, c: 30, d: 170, e: 50, f: 65, g: 95, h: 50, i: 100 },
        { w: 'Week11', a: 105, b: 100, c: 30, d: 90, e: 65, f: 95, g: 40, h: 95, i: 95 },
        { w: 'Week12', a: 100, b: 90, c: 65, d: 70, e: 195, f: 95, g: 80, h: 80, i: 100 }
      ],
      xkey: 'w',
      ykeys: ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i'],
      parseTime: false,
      labels: ['Neck', 'Shoulder', 'Chest', 'Arm', 'Forearm', 'Waist', 'Hip', 'Thigh', 'Calf'],
      resize: true,
      lineColors: ['#33414E', '#95B75D', '#f62e2e', '#139fe7', '#c1511f', '#00a0a6', '#f9a20a', '#03ba37', '#e713db']
    });
}();