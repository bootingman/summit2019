var stage = acgraph.create('blocks--container');
var layer1 = stage.layer();
var blocks = [];
var blocksCreated = false;

function Block(x,y) {
  this.x = x;
  this.y = y;
  this.dimension = blockInnerW;
  this.display = function() {
    layer1.rect(this.x, this.y, this.dimension, this.dimension).stroke('2 black 1');
  }
  this.hide = function() {
    layer1.rect(this.x, this.y, this.dimension, this.dimension).stroke('3 white 1');
  }
}

function makeBlocks() {
  stage.suspend();
  
  blocks = [];
  var index = 0;
  var x = 0;
  var y = 0;
  var xAmount = getBlocksAmountX(widthStage);
  var yAmount = getBlocksAmountX(heightStage);
  
  for (var i = 0; i <= yAmount; i++) {
    y = i * blockW + 1;
    for (var j = 0; j <= xAmount; j++) {
      x = j * blockW + 1;
      blocks[index] = new Block(x,y);
      index++;
    }
  }

  stage.resume();
  blocksCreated = true;
}

function render() {
  layer1.remove();
  stage.suspend();
  layer1 = stage.layer();

  for (var i = 0; i <= blocks.length - 1; i++) {
    blocks[i].display();
  }
  stage.resume();
}

// ANIMATION

var lineBlocks = [];
var lineBlocksSize;
var loop;
var lineMax = 100;
var animationFinished = false;
var beforeAnimation = true;
var startRemovingAnimationLoop = true;
var startBuildingAnimationLoop = true;

function getRandom() {
  var random = Math.floor(Math.random() * Math.floor(lineMax-1)) + 1;
  return random;
}

function getRandomX(x) {
  var random = Math.floor(Math.random() * Math.floor(x-1)) + 1;
  return random;
}

function makeLineBlocks() {
  var blocksAmount = blocks.length;
  var lineLength = 1;
  var index = 0;
  var position = 0;
  var sections = Math.floor(blocksAmount / lineMax);
  var section = Math.ceil( blocksAmount / (sections/4));
  var section1 = section;

  for (var i = 0; i <= blocksAmount - lineMax; i+=lineLength) {
    lineBlocks[index] = [position,lineLength];  
    position = position + lineLength;
    
    if (i < section1) {
      lineLength = getRandomX(20);
    } else {
      lineLength = getRandom();
    }

    index++;

  }

  var checkEND = 0;
  var lastF;
  
  for (var i = 0; i < lineBlocks.length; i++) {
    var l = lineBlocks[i][1];
    checkEND = checkEND + l;
  }

  lastF = blocksAmount - checkEND;
  lineBlocks[lineBlocks.length] = [checkEND,lastF];  
  loop = lineBlocks.length - 1;

}

function removingAnimation() {           
  setTimeout(function () {   

    stage.suspend();
    if (lineBlocks.length) {

      if (startRemovingAnimationLoop) {
        startRemovingAnimationLoop = false;
      }

      var index = Math.floor(Math.random()*(lineBlocks.length/2));
      var position = lineBlocks[index][0];
      var lineLength = lineBlocks[index][1];
      lineBlocks.splice(index, 1);

      for (var i = position; i < (position + lineLength); i++) {
        blocks[i].hide();
      }

    }

    stage.resume();
    loop--;                    

    if (loop >= -1) {           
      removingAnimation();
    }  else {
      animationFinished = true;
      removingAnimationFinished();

    }                       
  }, 10)
}

function buildingAnimation() {           
  setTimeout(function () {   

    stage.suspend();
    if (lineBlocks.length) {

      var index = Math.floor(Math.random()*(lineBlocks.length/6));
      
      var position = lineBlocks[index][0];
      var lineLength = lineBlocks[index][1];
      lineBlocks.splice(index, 1);

      for (var i = position; i < (position + lineLength); i++) {
        blocks[i].display();
      }

    }

    stage.resume();
    loop--;                    

    if (loop >= -1) {           
      buildingAnimation();
    }  else {
      animationFinished = true;
      buildingAnimationFinished();

    }                       
  }, 10)
}

function startRemovingAnimation() {
  beforeAnimation = false;
  makeLineBlocks();
  (function($) {
    $('.column--1').find('.block--fill').removeClass('block--available');
  })(jQuery);
  removingAnimation();
}

function startBuildingAnimation() {
  beforeAnimation = false;
  makeLineBlocks();
  buildingAnimation();
}

// FILL ANIMATION

function fillAnimation() {           
  setTimeout(function () {
    var xAmount = getBlocksAmountX(widthStage);
    var yAmount = getBlocksAmountX(heightStage);
    var xRandom = Math.floor(Math.random() * xAmount);
    var yRandom = Math.floor(Math.random() * yAmount);
    var colAmount = 0;
    var colRandom;

    (function($) {

      $('.block--available').each(function() {
        colAmount++;
      });
      
      colRandom = Math.floor(Math.random() * colAmount);
      
      $('.block--available').each(function(index) {
        if (index == colRandom) {
          var xNew = xRandom * blockW;
          var yNew = yRandom * blockW;
          var chance = Math.random(1);

          $('.block--available').removeClass('block--filled');
          $(this).css({
            left: xNew,
            top: yNew
          });
          if (chance > 0.666) $(this).addClass('block--filled');
        }
      });

      
    })(jQuery);

    fillAnimation();
  }, 2000)
}
