function RankGroupe(value) {
    if (value == 1) {
        return 'colorMembre';
    } else if (value == 2) {
        return 'colorPremium';
    } else if (value == 3) {
        return 'colorBOT';
    } else if (value == 4) {
        return 'colorAssistant';
    } else if (value == 5) {
        return 'colorTechnicien';
    } else if (value == 6) {
        return 'colorResponsable';
    } else if (value == 7) {
        return 'colorDev';
    } else if (value == 8) {
        return 'colorAdmin';
    }
}

function wordwrap (str, intWidth, strBreak, cut) {
  intWidth = arguments.length >= 2 ? +intWidth : 75
  strBreak = arguments.length >= 3 ? '' + strBreak : '\n'
  cut = arguments.length >= 4 ? !!cut : false
  var i, j, line
  str += ''
  if (intWidth < 1) {
    return str
  }
  var reLineBreaks = /\r\n|\n|\r/
  var reBeginningUntilFirstWhitespace = /^\S*/
  var reLastCharsWithOptionalTrailingWhitespace = /\S*(\s)?$/
  var lines = str.split(reLineBreaks)
  var l = lines.length
  var match

  for (i = 0; i < l; lines[i++] += line) {
    line = lines[i]
    lines[i] = ''
    while (line.length > intWidth) {
      var slice = line.slice(0, intWidth + 1)
      var ltrim = 0
      var rtrim = 0
      match = slice.match(reLastCharsWithOptionalTrailingWhitespace)
      if (match[1]) {
        j = intWidth
        ltrim = 1
      } else {
        j = slice.length - match[0].length
        if (j) {
          rtrim = 1
        }
        if (!j && cut && intWidth) {
          j = intWidth
        }
        if (!j) {
          var charsUntilNextWhitespace = (line.slice(intWidth).match(reBeginningUntilFirstWhitespace) || [''])[0]
          j = slice.length + charsUntilNextWhitespace.length
        }
      }
      lines[i] += line.slice(0, j - rtrim)
      line = line.slice(j + ltrim)
      lines[i] += line.length ? strBreak : ''
    }
  }
  return lines.join('\n')
}

function Tag(a) {
    var b = document.getElementById("message");
    b.value += "@" + a + " ";
    b.focus()
}