import sys
import string
import os
import re

from spellchecker import SpellChecker

spell = SpellChecker()

def main():
    filepath = sys.argv[-1]

    if not os.path.isfile(filepath):
        print("File path {} does not exist. Exiting....".format(filepath))
        sys.exit()


    unknown_text = open(filepath)

    with unknown_text as fp:
        for line in fp:
            print(" Analyzed Line: {}".format(line))

            check_alphanumeric(line)

    unknown_text.close()

def check_alphanumeric(each_line):
    if any (c not in string.printable for c in each_line):
        print("bad")
        return
    #final = re.sub('[\W ]',' ',each_line)
    correction(each_line)


def correction(unknown_string):
    words = spell.split_words(unknown_string)
    for word in words:
        temp = spell.correction(word)
        if temp != word:
            print(spell.correction(word))



if __name__ == "__main__":
    main()
