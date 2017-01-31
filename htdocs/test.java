import java.io.*;
import java.util.*;

public class Solution {

    public static void main(String[] args) {
        /* Enter your code here. Read input from STDIN. Print output to STDOUT. Your class should be named Solution. */
        Scanner input = new Scanner(System.in);
        int num = input.nextInt();
        String[] strings = new String[num];
        for(int i=0;i<num;i++){
            strings[i] = input.next();
        }
        int[] out = new int[num];
        for(int j =0;j<num;j++){
            String s = strings[j];
            char first = s.charAt(0);
            char second;
            if(first =='A'){
                second = 'B';
            }
            else{
                second = 'A';
            }
            StringBuilder sb = new StringBuilder();
            sb.append(first);
            char last = first;
            for(int k=1;k<s.length();k++){
                char x = s.charAt(k);
                if(x != last){
                    sb.append(x);
                }
                last = x;
                
            }
            String res = sb.toString();
            out[j] = s.length() - res.length();
        }
        
        for(int l=0;l<out.length;l++){
            System.out.println(out[l]);
        }
    }
}