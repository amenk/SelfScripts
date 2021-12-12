import os, string, sys
from PIL import Image

#renames photos so they contain the date of recording in the filename

def get_exif_data(file):
        image = Image.open(file)
        exif_data = image._getexif()
        try:
            exif = exif_data[36868]
            return '%s-%s-%s' % (exif[:4], exif[5:7], exif[8:10]) 
        except (KeyError, TypeError):
            return '0000-00-00';


if len(sys.argv) == 1:  # wenn keine Dateinamen angegeben sind,
    filenames = os.listdir(os.curdir)  # nimm das aktuelle Verzeichnis

else:  # ansonsten die angegebenen Dateien
    filenames = sys.argv[1:]  # aus der Kommandozeile

for filename in filenames:
    newfilename = '%s_%s' % (get_exif_data(filename) , filename)
    os.rename(filename, newfilename)


