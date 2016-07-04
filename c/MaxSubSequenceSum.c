/* 求最大的子序列和的联机算法 */

#include "stdio.h"

#define LEN 26

int  MaxSubSequenceSum(const int arr[],int len)
{
  int  tmpSum, maxSum, j;
  tmpSum = maxSum = 0;
  
  for( j=0; j<len; j++ )
  {
    tmpSum += arr[j];
    if(tmpSum > maxSum){
      maxSum = tmpSum;
    }
    else if(tmpSum < 0){
      tmpSum = 0;
    }
  }
  return maxSum;
}




int main(){
  
  // 4,5,6,7 = 22
  int arr[LEN] = {18,-15,1,2,-19,-20,3,12,-13,-14,20,-15,-20,4,5,6,7,-16,-17,-10,15,-8,9,-10,11,-20};
  int maxSum,i;

  printf("array:\n");
  for(i = 0; i < LEN; i++){
    printf("%d ",arr[i]); 
  }
  
  maxSum = MaxSubSequenceSum(arr,LEN);

  printf("\nmax sub sequence sum:%d\n",maxSum);
}