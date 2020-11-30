#!/usr/bin/python3
# -*- coding: <encoding utf-8> -*-
import sys
import nltk
nltk.data.path.append('nltk_data')

from nltk.tokenize import sent_tokenize
from nltk.tokenize import word_tokenize
from nltk.tokenize import TreebankWordTokenizer
from nltk.tokenize import RegexpTokenizer
from nltk.corpus import stopwords
from nltk.corpus import wordnet as wn
from nltk.probability import *
from nltk.stem import *
from nltk.stem.snowball import SnowballStemmer
import itertools
import re
from nltk.collocations import *

#GLOBAL VARIABLES
#coef_contournement

#===========================================================================
def get_texte(name):
   """Renvoie le contenu du document name"""
   #with open(name, 'r', encoding='utf-8') as myfile:
   with open(name, 'r', encoding='utf-8') as myfile:
        data=myfile.read()
        return data

#===========================================================================
def stop_ponc(liste):
    """Supprime les caractères de ponctuation les plus courants"""
    ponctuation=['.',',','-','...',':','(',')',"'",'>','=','#','«','»','’','``',"''",'[',']','!','?']
    return [word for word in liste if word not in ponctuation]


#===========================================================================
def stop_complete(liste):
    """Complète la liste des stopwords de NLTK qui s'avère très limitée"""
    mots=["d'un",'tout','quand',"qu'il","chez","c'est","ils","sans",'les','cette','plus','comme','a','si','donc','être',"y'a","d'un","j'ai","fait","quel","quelle"]
    return [word for word in liste if word not in mots]


#===========================================================================
def mots_interdits():
   """
   Récupère la liste des mots interdits contenus dans un fichier txt
   """
   #with open('model/NLTK/liste_noire.txt', 'r', encoding='utf-8') as myfile:
   with open('liste_noire.txt', 'r', encoding='utf-8') as myfile:
        raw=myfile.read()
        liste=raw.split("\n")
        return liste


#===========================================================================
def mots_gris():
   """
   Récupère la liste des mots à connotation négative contenus dans un fichier txt
   """
   #with open('model/NLTK/liste_grise.txt', 'r', encoding='utf-8') as myfile:
   with open('liste_grise.txt', 'r', encoding='utf-8') as myfile:
        raw=myfile.read()
        liste=raw.split("\n")
        return liste


#===========================================================================
def preparation(com):
   """
   Met tous les caractères en minuscule et supprime certains caractères de ponctuation
   """
   com=com.lower()
   com=com.replace('.',"")
   com=com.replace(',',"")
   com=com.replace(':',"")
   com=com.replace('\n'," ")
   return com


#===========================================================================
def preparation_second_degre(texte):
   """
   Supprime les mots les plus courant dans la langue française et qui ne sont pas porteurs de sens.
   Supprime la plupart des caractères spéciaux.
   """
   french_stops = set(stopwords.words('french'))
   words=word_tokenize(texte)
   retenus=[word for word in words if word not in french_stops]
   retenus=stop_ponc(retenus)
   retenus=stop_complete(retenus)
   return retenus


#===========================================================================
def most_commons(retenus):
   """
   Classe les mots d'un texte par ordre décroissant de fréquence
   """
   freq=nltk.FreqDist(retenus)
   most_common=freq.most_common()
   sorted_most_common=list(itertools.chain(*(sorted(ys) for k, ys in itertools.groupby(most_common, key=lambda t: t[1]))))
   return sorted_most_common


#===========================================================================
def binomes(tokens):
   """
   Renvoie les collocations d'un texte, c'est à dire des paires de mots souvent associés ensembles
   """
   bigram_measures = nltk.collocations.BigramAssocMeasures()
   finder = BigramCollocationFinder.from_words(tokens, window_size = 2)
   finder.apply_freq_filter(1)
   colls = finder.nbest(bigram_measures.likelihood_ratio, 5)
   return colls


#===========================================================================
def forbidden(com):
   """
   Recherche la présence de mots interdits dans un texte.
   Renvoie True s'il en contient.
   """
   com=preparation(com)
   forbidden=mots_interdits()
   liste_interdits=[]
   for i in forbidden:
      if stem_search(i,com)==True:
         liste_interdits.append(i)
   for i in forbidden:
      if ' '+i+' ' in com:
         #print('ici')
         liste_interdits.append(i)
   if(len(liste_interdits)>0):
      return True
   else:
      return False

#===========================================================================
def stem_search(expression,com):
   """
   Compare les radicaux de deux expressions et renvoie True s'ils correspondent
   """
   stemmer=SnowballStemmer("french")
   com=preparation(com)
   liste_com=com.split(' ')
   for m in range (0, len(liste_com)):
      liste_com[m]=stemmer.stem(liste_com[m])
   liste_expr=expression.split(' ')
   nb_true=0
   for i in liste_expr:
      for mot in liste_com:
         if stemmer.stem(i)==mot:
##            print(i+' = '+mot)
            nb_true+=1
   if nb_true==len(liste_expr):
      ##print(com)
      return True
   return False
#===========================================================================
def suspicious(com):
   """
   Recherche la présence de mots à connotation négative dans un texte.
   Renvoie True s'il en contient.
   """
   liste_gris=[]
   com=preparation(com)
   grey=mots_gris()
   total=len(com.split(" "))
   nb_grey=0
   for m in grey:
      if stem_search(m,com)==True:
         liste_gris.append(m)
      if (m in com) and m!='':
         nb_grey+=len(m.split(' '))
         liste_gris.append(m)
   pourc=round(nb_grey/total , 2)
   if(pourc>0.1):
      return True
   else:
      return False


#===========================================================================
def contournement(com):
   """
   Repère les mots contenant le caractère '*' et cherche s'ils peuvent correspondre à des mots interdits.
   Exemple: "Tu es ***" renverra la valeur True alors que "4*3+5" renverra la valeur False.
   """
   liste_mots=com.split(' ')
   liste_prop=[]
   liste_mots_suspects={}
   for m in liste_mots:
      nb=m.count('*')
      if  nb>0:
         max_prop=0
         long=len(m)
         forbidden=mots_interdits()
         for i in forbidden:
            if len(i)==long:
               nb_lettres=0
               nb_idem=0
               for k in range(0,long):
                  if m[k]!='*':
                     nb_lettres+=1
                     if m[k]==i[k]:
                        nb_idem+=1
               if nb_lettres>0:
                  proportion=nb_idem/nb_lettres
               else:
                  proportion=1
               if (proportion>0.6):
                  if(max_prop==0):
                     liste_mots_suspects[m]=[i]
                  else:
                     liste_mots_suspects[m].append(i)
                  if (proportion>max_prop):
                     max_prop=proportion
         if(max_prop>0):
            liste_prop.append(max_prop) 
            
   if(len(liste_mots_suspects)>0):
      return True
   else:
      return False
                        

#===========================================================================
def most_common_words(com):
   """
   Cherche des correspondances entre les mots les plus courants dans la base de données des commentaires négatifs et le commentaire.
   """
   data=get_texte('BDD_insultes.txt')
   post_filtre=preparation(data)
   post_filtre=preparation_second_degre(post_filtre)
   most_common=most_commons(post_filtre)
   stop_nb=min(500,max(min(100,len(most_common)),len(most_common)//5))
   total=len(com.split(" "))
   nb_common=0
   for i in range (0,stop_nb):
      m=' '+most_common[i][0]+' '
      if m in com:
         nb_common+=1
         #print("Common: "+m)
   coef=round(nb_common/total , 2)
   if(coef>0.1):
      return True
   else:
      return False


#===========================================================================
def colloc(com):
   """
   Cherche des correspondances entre les collocations extraites de la base de données de commentaires négatifs et le commentaire
   """
   data=get_texte('BDD_insultes.txt')
   post_filtre=preparation(data)
   post_filtre=preparation_second_degre(post_filtre)
   binome=binomes(post_filtre)
   nb_match=0
   for b in binome:
       if (b[0] in com) and (b[1] in com):
           nb_match+=1
   if nb_match>0:
       return True
   else:
       return False


#===========================================================================
def analyser(com):
    """
    Procède à toutes les analyses et renvoie un taux de confiance pour le commentaire rentré:
	1.0 --> Le commentaire contient un mot interdit et doit être directement modéré
	0.9/0.8/0.6/0.5--> Plus le taux est élevé plus il y a de chances que le commentaire soit non-conforme. Le commentaire doit être signalé
	0.0 --> Rien ne semble suspect, le commentaire peut être affiché directement.
    """
    com=preparation(com)
    bool_interdit=forbidden(com)
    #print(bool_interdit)
    if(bool_interdit):
       return 1.0        #print("Commentaire refusé car ces mots sont interdits: {}".format(mots_interdits))
       
    verif_grey=suspicious(com)
    verif_star=contournement(com)
    verif_common=most_common_words(com)
    verif_colloc=colloc(com)

    nbTrue=verif_grey+verif_star+verif_common+verif_colloc

    if (nbTrue==4):
        return 0.9
    elif (nbTrue==3 or (verif_grey and verif_star) or (verif_grey and verif_colloc)):
        return 0.8
    elif (nbTrue==2):
        return 0.6
    elif (nbTrue==1):
        return 0.5
    else:
        return 0.0
    
#----------------------------------------------------------------------
if __name__ == "__main__" :
    com=get_texte('monCommentaire.txt')
    accepte=analyser(com)
    print(accepte)
    
##    if(accepte==1.0):
##        print('REFUSE')
##    elif(accepte>0.0):
##        print('VERIFIER')
##    else:
##        print('ACCEPTE')

